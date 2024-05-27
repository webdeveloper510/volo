<?php

namespace App\Http\Controllers;


use App\Models\Coupon;
use App\Models\Invoice;
use App\Models\InvoicePayment;
use App\Models\Order;
use App\Models\Plan;
use App\Models\Transaction;
use App\Models\UserCoupon;
use App\Models\Utility;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Session;
use Stripe;
use Illuminate\Support\Facades\Auth;

class StripePaymentController extends Controller
{
    public $currancy;
    public $currancy_symbol;

    public $stripe_secret;
    public $stripe_key;
    public $stripe_webhook_secret;

    public function index()
    {
        $objUser = \Auth::user();
        if ($objUser->type == 'super admin') {
            $orders = Order::select(
                [
                    'orders.*',
                    'users.name as user_name',
                ]
            )->join('users', 'orders.user_id', '=', 'users.id')->orderBy('orders.created_at', 'DESC')->with('total_coupon_used.coupon_detail')->get();
        } else {
            $orders = Order::select(
                [
                    'orders.*',
                    'users.name as user_name',
                ]
            )->join('users', 'orders.user_id', '=', 'users.id')->orderBy('orders.created_at', 'DESC')->where('users.id', '=', $objUser->id)->with('total_coupon_used.coupon_detail')->get();
        }

        return view('order.index', compact('orders'));
    }

    public function stripePost(Request $request)
    {
        $this->planpaymentSetting();
        $objUser = \Auth::user();
        $planID  = \Illuminate\Support\Facades\Crypt::decrypt($request->plan_id);
        $plan    = Plan::find($planID);
        if ($plan) {
            try {
                $price = $plan->price;
                if (!empty($request->coupon)) {
                    $coupons = Coupon::where('code', strtoupper($request->coupon))->where('is_active', '1')->first();
                    if (!empty($coupons)) {
                        $usedCoupun     = $coupons->used_coupon();
                        $discount_value = ($plan->price / 100) * $coupons->discount;
                        $price          = $plan->price - $discount_value;

                        if ($usedCoupun >= $coupons->limit) {
                            return redirect()->back()->with('error', __('This coupon code has expired.'));
                        }
                    } else {
                        return redirect()->back()->with('error', __('This coupon code is invalid or has expired.'));
                    }
                }

                $orderID = strtoupper(str_replace('.', '', uniqid('', true)));
                if ($price > 0.0) {
                    Stripe\Stripe::setApiKey($this->stripe_secret);
                    $data = Stripe\Charge::create(
                        [
                            "amount" => 100 * $price,
                            "currency" => "inr",
                            "source" => $request->stripeToken,
                            "description" => " Plan - " . $plan->name,
                            "metadata" => ["order_id" => $orderID],
                        ]
                    );
                } else {
                    $data['amount_refunded']                             = 0;
                    $data['failure_code']                                = '';
                    $data['paid']                                        = 1;
                    $data['captured']                                    = 1;
                    $data['status']                                      = 'succeeded';
                    $data['payment_method_details']['card']['last4']     = '';
                    $data['payment_method_details']['card']['exp_month'] = '';
                    $data['payment_method_details']['card']['exp_year']  = '';
                    $data['currency']                                    = ($this->currancy) ? strtolower($this->currancy) : 'inr';
                    $data['receipt_url']                                 = 'free coupon';
                    $data['balance_transaction']                         = 0;
                }

                if ($data['amount_refunded'] == 0 && empty($data['failure_code']) && $data['paid'] == 1 && $data['captured'] == 1) {

                    Order::create(
                        [
                            'order_id' => $orderID,
                            'name' => $request->name,
                            'card_number' => isset($data['payment_method_details']['card']['last4']) ? $data['payment_method_details']['card']['last4'] : '',
                            'card_exp_month' => isset($data['payment_method_details']['card']['exp_month']) ? $data['payment_method_details']['card']['exp_month'] : '',
                            'card_exp_year' => isset($data['payment_method_details']['card']['exp_year']) ? $data['payment_method_details']['card']['exp_year'] : '',
                            'plan_name' => $plan->name,
                            'plan_id' => $plan->id,
                            'price' => $price,
                            'price_currency' => isset($data['currency']) ? $data['currency'] : '',
                            'txn_id' => isset($data['balance_transaction']) ? $data['balance_transaction'] : '',
                            'payment_status' => isset($data['status']) ? $data['status'] : 'succeeded',
                            'payment_type' => __('STRIPE'),
                            'receipt' => isset($data['receipt_url']) ? $data['receipt_url'] : 'free coupon',
                            'user_id' => $objUser->id,
                        ]
                    );


                    if (!empty($request->coupon)) {
                        $userCoupon         = new UserCoupon();
                        $userCoupon->user   = $objUser->id;
                        $userCoupon->coupon = $coupons->id;
                        $userCoupon->order  = $orderID;
                        $userCoupon->save();
                        $usedCoupun = $coupons->used_coupon();
                        if ($coupons->limit <= $usedCoupun) {
                            $coupons->is_active = 0;
                            $coupons->save();
                        }
                    }

                    if ($data['status'] == 'succeeded') {
                        $assignPlan = $objUser->assignPlan($plan->id, $request->frequency);
                        if ($assignPlan['is_success']) {
                            return redirect()->route('plan.index')->with('success', __('Plan activated Successfully!'));
                        } else {
                            return redirect()->route('plan.index')->with('error', __($assignPlan['error']));
                        }
                    } else {
                        return redirect()->route('plan.index')->with('error', __('Your Payment has failed!'));
                    }
                } else {
                    return redirect()->route('plan.index')->with('error', __('Transaction has been failed!'));
                }
            } catch (\Exception $e) {
                return redirect()->route('plan.index')->with('error', __($e->getMessage()));
            }
        } else {
            return redirect()->route('plan.index')->with('error', __('Plan is deleted.'));
        }
    }

    public function planGetStripePaymentStatus(Request $request)
    {
        $this->planpaymentSetting();

        Session::forget('stripe_session');
        try {

            if ($request->return_type == 'success') {
                $objUser                    = \Auth::user();

                $assignPlan = $objUser->assignPlan($request->plan_id);
                // if($assignPlan['is_success'])
                // {
                //     return redirect()->route('plan.index')->with('success', __('Plan successfully activated.'));
                // }

                $plan = \DB::table('plans')->find($request->plan_id);


                if ($assignPlan['is_success'] == true  && !empty($plan)) {
                    // if(!empty($authuser->payment_subscription_id) && $authuser->payment_subscription_id != '')
                    // {
                    //     try
                    //     {
                    //         $authuser->cancel_subscription($authuser->id);
                    //     }
                    //     catch(\Exception $exception)
                    //     {
                    //         \Log::debug($exception->getMessage());
                    //     }
                    // }

                    $orderID = strtoupper(str_replace('.', '', uniqid('', true)));
                    Order::create(
                        [
                            'order_id' => $orderID,
                            'name' => null,
                            'email' => null,
                            'card_number' => null,
                            'card_exp_month' => null,
                            'card_exp_year' => null,
                            'plan_name' => $plan->name,
                            'plan_id' => $plan->id,
                            'price' => $plan->price,
                            'price_currency' => !empty(env('CURRENCY_CODE')) ? env('CURRENCY_CODE') : 'usd',
                            'txn_id' => '',
                            'payment_type' => __('Stripe'),
                            'payment_status' => 'succeeded',
                            'receipt' => null,
                            'user_id' => \Auth::user()->id,
                        ]
                    );

                    return redirect()->route('plan.index')->with('success', __('Plan activated Successfully!'));
                } else {
                    return redirect()->route('plan.index')->with('error', __($assignPlan['error']));
                }
            } else {
                return redirect()->route('plan.index')->with('error', __('Your Payment has failed!'));
            }
        } catch (\Exception $exception) {
            return redirect()->route('plan.index')->with('error', $exception->getMessage());
        }
    }

    public function invoicePayWithStripe(Request $request)
    {
        $amount = $request->amount;
        $settings = Utility::settings();

        $validatorArray = [
            'amount' => 'required',
            'invoice_id' => 'required',
        ];
        $validator      = Validator::make(
            $request->all(),
            $validatorArray
        )->setAttributeNames(
            ['invoice_id' => 'Invoice']
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        $invoice = Invoice::find($request->invoice_id);

        $this->paymentSetting($invoice->created_by);

        $amount = number_format((float)$request->amount, 2, '.', '');

        $invoice_getdue = number_format((float)$invoice->getDue(), 2, '.', '');

        if ($invoice_getdue < $amount) {
            return Utility::error_res('not correct amount');
        }

        try {


            $stripe_formatted_price = in_array(
                $this->currancy,
                [
                    'MGA',
                    'BIF',
                    'CLP',
                    'PYG',
                    'DJF',
                    'RWF',
                    'GNF',
                    'UGX',
                    'JPY',
                    'VND',
                    'VUV',
                    'XAF',
                    'KMF',
                    'KRW',
                    'XOF',
                    'XPF',
                ]
            ) ? number_format($amount, 2, '.', '') : number_format($amount, 2, '.', '') * 100;

            $return_url_parameters = function ($return_type) {
                return '&return_type=' . $return_type . '&payment_processor=stripe';
            };

            /* Initiate Stripe */
            \Stripe\Stripe::setApiKey($this->stripe_secret);



            $stripe_session = \Stripe\Checkout\Session::create(
                [
                    'payment_method_types' => ['card'],
                    'line_items' => [
                        [
                            'name' => $settings['company_name'] . " - " . User::invoiceNumberFormat($invoice->invoice_id),
                            'description' => 'payment for Invoice',
                            'amount' => $stripe_formatted_price,
                            'currency' => $this->currancy,
                            'quantity' => 1,
                        ],
                    ],
                    'metadata' => [
                        'invoice_id' => $request->invoice_id,
                    ],
                    'success_url' => route(
                        'invoice.stripe',
                        [
                            'invoice_id' => encrypt($request->invoice_id),
                            'TXNAMOUNT' => $amount,
                            $return_url_parameters('success'),
                        ]
                    ),
                    'cancel_url' => route(
                        'invoice.stripe',
                        [
                            'invoice_id' => encrypt($request->invoice_id),
                            'TXNAMOUNT' => $amount,
                            $return_url_parameters('cancel'),
                        ]
                    ),
                ]
            );


            $stripe_session = $stripe_session ?? false;

            try {
                return new RedirectResponse($stripe_session->url);
            } catch (\Exception $e) {
                \Log::debug($e->getMessage());
                return redirect()->route('pay.invoice', \Illuminate\Support\Facades\Crypt::encrypt($request->invoice_id))->with('error', __('Transaction has been failed!'));
            }
        } catch (\Exception $e) {
            \Log::debug($e->getMessage());
            return redirect()->route('pay.invoice', \Illuminate\Support\Facades\Crypt::encrypt($request->invoice_id))->with('error', __('Transaction has been failed!'));
        }
    }

    public function getInvociePaymentStatus(Request $request, $invoice_id)
    {

        Session::forget('stripe_session');
        try {
            if ($request->return_type == 'success') {
                if (!empty($invoice_id)) {


                    $invoice_id = decrypt($invoice_id);
                    $invoice    = Invoice::find($invoice_id);
                    $this->paymentSetting($invoice->created_by);
                    $objUser = \Auth::user();
                    $user = User::where('id',$invoice->created_by)->first();
                    $objUser = $user;
                    if ($invoice) {
                        try {
                            if ($request->return_type == 'success') {
                                $invoice_payment                 = new InvoicePayment();
                                $invoice_payment->transaction_id = app('App\Http\Controllers\InvoiceController')->transactionNumber($invoice->created_by);
                                $invoice_payment->invoice_id     = $invoice_id;
                                $invoice_payment->amount         = isset($request->TXNAMOUNT) ? $request->TXNAMOUNT : 0;
                                $invoice_payment->date           = date('Y-m-d');
                                $invoice_payment->payment_id     = 0;
                                $invoice_payment->payment_type   = __('STRIPE');
                                $invoice_payment->client_id      = 0;
                                $invoice_payment->notes          = '';
                                $invoice_payment->save();

                                $invoice_getdue = number_format((float)$invoice->getDue(), 2, '.', '');

                                if ($invoice_getdue <= 0.0) {

                                    Invoice::change_status($invoice->id, 3);
                                } else {

                                    Invoice::change_status($invoice->id, 2);
                                }

                                $setting  = Utility::settingsById($objUser->creatorId());
                                if (isset($setting['payment_notification']) && $setting['payment_notification'] == 1) {
                                    $uArr = [
                                        'amount' => $invoice_payment->amount,
                                        'payment_type' => $invoice_payment->payment_type,
                                        'user_name' => $invoice->name,
                                    ];
                                    Utility::send_twilio_msg($invoice->contacts->phone, 'new_invoice_payment', $uArr, $invoice->created_by);
                                }

                                //webhook
                                $module = 'New Invoice Payment';
                                $webhook =  Utility::webhookSetting($module, $invoice->created_by);
                                if ($webhook) {
                                    $parameter = json_encode($invoice);
                                    // 1 parameter is  URL , 2 parameter is data , 3 parameter is method
                                    $status = Utility::WebhookCall($webhook['url'], $parameter, $webhook['method']);
                                    if ($status != true) {
                                        $msg = "Webhook call failed.";
                                    }
                                }
                                if (Auth::user()) {
                                    return redirect()->route('invoice.show', $invoice_id)->with('success', __('Invoice paid Successfully!') . ((isset($msg) ? '<br> <span class="text-danger">' . $msg . '</span>' : '')));
                                } else {
                                    $id = \Crypt::encrypt($invoice_id);
                                    return redirect()->route('pay.invoice', $id)->with('success', __('Invoice paid Successfully!') . ((isset($msg) ? '<br> <span class="text-danger">' . $msg . '</span>' : '')));
                                }
                            }


                            //     return redirect()->route('pay.invoice', \Illuminate\Support\Facades\Crypt::encrypt($invoice_id))->with('success', __('Payment added Successfully'));
                            // } else {
                            //     return redirect()->route('pay.invoice', \Illuminate\Support\Facades\Crypt::encrypt($invoice_id))->with('error', __('Transaction has been failed!'));
                            // }
                        } catch (\Exception $e) {

                            return redirect()->route('pay.invoice', \Illuminate\Support\Facades\Crypt::encrypt($invoice_id))->with('error', __('Transaction has been failed!'));
                        }
                    } else {

                        return redirect()->route('pay.invoice', \Illuminate\Support\Facades\Crypt::encrypt($invoice_id))->with('error', __('Invoice not found.'));
                    }
                } else {

                    return redirect()->route('pay.invoice', \Illuminate\Support\Facades\Crypt::encrypt($invoice_id))->with('error', __('Invoice not found.'));
                }
            } else {

                return redirect()->route('pay.invoice', \Illuminate\Support\Facades\Crypt::encrypt($invoice_id))->with('error', __('Transaction has been failed!'));
            }
        } catch (\Exception $exception) {
            return redirect()->route('pay.invoice', \Illuminate\Support\Facades\Crypt::encrypt($invoice_id))->with('error', $exception->getMessage());
        }
    }

    public function paymentSetting($id)
    {

        $admin_payment_setting = Utility::invoice_payment_settings($id);

        $this->currancy_symbol = isset($admin_payment_setting['currency_symbol']) ? $admin_payment_setting['currency_symbol'] : '';
        $this->currancy = isset($admin_payment_setting['currency']) ? $admin_payment_setting['currency'] : '';
        $this->stripe_secret = isset($admin_payment_setting['stripe_secret']) ? $admin_payment_setting['stripe_secret'] : '';
        $this->stripe_key = isset($admin_payment_setting['stripe_key']) ? $admin_payment_setting['stripe_key'] : '';
        $this->stripe_webhook_secret = isset($admin_payment_setting['stripe_webhook_secret']) ? $admin_payment_setting['stripe_webhook_secret'] : '';
    }

    public function planpaymentSetting()
    {

        $admin_payment_setting = Utility::payment_settings();

        $this->currancy_symbol = isset($admin_payment_setting['currency_symbol']) ? $admin_payment_setting['currency_symbol'] : '';
        $this->currancy = isset($admin_payment_setting['currency']) ? $admin_payment_setting['currency'] : '';

        $this->stripe_secret = isset($admin_payment_setting['stripe_secret']) ? $admin_payment_setting['stripe_secret'] : '';
        $this->stripe_key = isset($admin_payment_setting['stripe_key']) ? $admin_payment_setting['stripe_key'] : '';
        $this->stripe_webhook_secret = isset($admin_payment_setting['stripe_webhook_secret']) ? $admin_payment_setting['stripe_webhook_secret'] : '';
    }
}

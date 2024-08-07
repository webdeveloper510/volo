<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AccountIndustry;
use App\Models\AccountType;
use App\Models\Campaign;
use App\Models\Contact;
use App\Models\Document;
use App\Models\Lead;
use App\Models\LeadSource;
use App\Models\Plan;
use App\Models\Stream;
use App\Models\Task;
use App\Models\Utility;
use App\Models\Billing;
use App\Models\Proposal;
use App\Models\ProposalInfo;
use App\Mail\ProposalResponseMail;
use App\Models\User;
use App\Models\UserDefualtView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\SendPdfEmail;
use App\Mail\SendNdaEmail;
use App\Mail\LeadWithrawMail;
use App\Mail\SendOpportunityEmail;
use App\Models\MasterCustomer;
use App\Models\NotesLeads;
use App\Models\Nda;
use Log;
use Mail;
use PhpParser\Node\Stmt\ElseIf_;
use Str;
use App\Models\LeadDoc;
use App\Models\UserImport;
use Storage;
use Spatie\Permission\Models\Role;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!\Auth::user()->can('Manage Opportunity')) {
            return redirect()->back()->with('error', 'Permission Denied');
        }

        $statuss = Lead::$stat;
        $user = \Auth::user();
        $userRole = Role::find($user->user_roles);
        $userType = $user->type;
        $userRoleType = $userRole->roleType;
        $userRoleName = $userRole->name;

        if ($userType == 'owner' || $userType == 'admin' || $userType == 'snr manager') {
            $leads = Lead::with('accounts', 'assign_user')
                ->orderby('id', 'desc')
                ->get();
        } elseif ($userType == 'manager') {
            if ($userRoleType == 'individual') {
                $userTeamMemberIds = User::where('team_member', $user->id)->pluck('id')->toArray();
                $leads = Lead::with('accounts', 'assign_user')
                    ->where(function ($query) use ($user, $userTeamMemberIds) {
                        $query->whereIn('assigned_user', $userTeamMemberIds)
                            ->orWhere('assigned_user', $user->id);
                    })
                    ->orderBy('id', 'desc')
                    ->get();
            } elseif ($userRoleType == 'company') {
                $leads = Lead::with('accounts', 'assign_user')
                    ->where('created_by', $user->creatorId())
                    ->orderby('id', 'desc')
                    ->get();
            }
        } elseif ($userType == 'executive') {
            if ($userRoleType == 'individual') {
                $leads = Lead::where('assigned_user', $user->id)
                    ->orderby('id', 'desc')
                    ->get();
            } elseif ($userRoleType == 'company') {
                $leads = Lead::with('accounts', 'assign_user')
                    ->where('created_by', $user->creatorId())
                    ->orderby('id', 'desc')
                    ->get();
            }
        } elseif ($userRoleName == 'restricted') {
            $leads = Lead::where('assigned_user', $user->id)
                ->orderBy('id', 'desc')
                ->get();
        }

        $defualtView = new UserDefualtView();
        $defualtView->route = \Request::route()->getName();
        $defualtView->module = 'lead';
        $defualtView->view = 'list';
        User::userDefualtView($defualtView);
        return view('lead.index', compact('leads', 'statuss', 'userType', 'userRoleType'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type, $id)
    {
        // echo "here";
        // die;
        if (\Auth::user()->can('Create Opportunity')) {
            $users = User::where('created_by', \Auth::user()->creatorId())->get();
            $clients = UserImport::all();
            $status = Lead::$status;
            $attendees_lead = Lead::where('created_by', \Auth::user()->creatorId())->where('status', 4)->where('lead_status', 1)->get()->pluck('leadname', 'id');
            $attendees_lead->prepend('Select Client', 0);
            $assinged_staff = User::whereNotIn('id', [1, 3])->get();
            return view('lead.create', compact('status', 'users', 'id', 'type', 'attendees_lead', 'clients', 'assinged_staff'));
        } else {
            return redirect()->back()->with('error', 'permission Denied');
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());
        // die;

        if (\Auth::user()->can('Create Opportunity')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'opportunity_name' => 'required',
                    'primary_name' => 'required',
                    'primary_phone_number' => 'required',
                    'primary_email' => 'required',
                    'primary_address' => 'required',
                    'primary_organization' => 'required',
                    'assign_staff' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first())
                    ->withErrors($validator)
                    ->withInput();
            }

            // function processProductData($request, $productType)
            // {
            //     $products = [];

            //     $titles = $request->input("product_title_$productType");
            //     $prices = $request->input("product_price_$productType");
            //     $quantities = $request->input("product_quantity_$productType");
            //     $units = $request->input("unit_$productType");
            //     $opportunity_values = $request->input("product_opportunity_value_$productType");

            //     if ($titles && $prices && $quantities && $units && $opportunity_values) {
            //         for ($i = 0; $i < count($titles); $i++) {
            //             $products[] = [
            //                 'title' => $titles[$i] ?? '',
            //                 'price' => $prices[$i] ?? '',
            //                 'quantity' => $quantities[$i] ?? '',
            //                 'unit' => $units[$i] ?? '',
            //                 'opportunity_value' => $opportunity_values[$i] ?? '',
            //             ];
            //         }
            //     }

            //     return $products;
            // }

            // // Process each product type
            // $hardware_one_time = processProductData($request, 'hardware_one_time');
            // $hardware_maintenance = processProductData($request, 'hardware_maintenance');
            // $software_recurring = processProductData($request, 'software_recurring');
            // $software_one_time = processProductData($request, 'software_one_time');
            // $systems_integrations = processProductData($request, 'systems_integrations');
            // $subscriptions = processProductData($request, 'subscriptions');
            // $tech_deployment = processProductData($request, 'tech_deployment');

            $formData = json_decode($request->input('formData'), true);
            // echo "<pre>";
            // print_r($formData);
            // die;

            // Save data to leads table
            $lead = new Lead();
            $lead['user_id'] = $request->existing_client  ?? '';
            $lead['opportunity_name'] = $request->opportunity_name;
            $lead['assigned_user'] = $request->assign_staff;
            $lead['primary_name'] = $request->primary_name;
            $lead['primary_email'] = $request->primary_email;
            $lead['primary_contact'] = $request->primary_phone_number;
            $lead['primary_address'] = $request->primary_address;
            $lead['primary_organization'] = $request->primary_organization;
            $lead['secondary_name'] = $request->secondary_name ?? '';
            $lead['secondary_email'] = $request->secondary_email ?? '';
            $lead['secondary_contact'] = $request->secondary_phone_number ?? '';
            $lead['secondary_address'] = $request->secondary_address ?? '';
            $lead['secondary_designation'] = $request->secondary_designation ?? '';
            $lead['region'] = $request->region ?? $request->existing_region;
            $lead['sales_stage'] = $request->sales_stage ?? '';
            $lead['value_of_opportunity'] = $request->value_of_opportunity ?? '';
            $lead['deal_length'] = $request->deal_length ?? '';
            $lead['difficult_level'] = $request->difficult_level ?? '';
            $lead['start_time'] = $request->start_time ?? '';
            $lead['end_time'] = $request->end_time ?? '';
            $lead['timing_close'] = $request->timing_close ?? '';
            $lead['probability_to_close'] = $request->probability_to_close ?? '';
            $lead['currency'] = $request->currency ?? '';
            $lead['lead_status'] = ($request->is_active == 'on') ? 1 : 0;
            $lead['category'] = $request->category ?? '';
            $lead['sales_subcategory'] = $request->sales_subcategory ?? '';
            $lead['competitor'] = $request->competitor ?? '';
            $lead['products'] = json_encode(array_keys($formData)) ?? '';
            $lead['product_details'] = json_encode($formData);
            $lead['hardware_one_time'] = '';
            $lead['hardware_maintenance'] = '';
            $lead['software_recurring'] = '';
            $lead['software_one_time'] = '';
            $lead['systems_integrations'] = '';
            $lead['subscriptions'] = '';
            $lead['tech_deployment_volume_based'] = '';
            $lead['created_by'] = \Auth::user()->id;
            $lead->save();

            // Get the last inserted ID
            $lastInsertedId = $lead->id;

            if ($lead && $request->has('newevent') && $request->newevent === 'New') {
                $UsersImports = new UserImport();
                $UsersImports->lead_id = $lastInsertedId;
                $UsersImports->company_name = $request->company_name ?? '';
                $UsersImports->entity_name = '';
                $UsersImports->client_name = $request->client_name ?? '';
                $UsersImports->primary_name = $request->primary_name ?? '';
                $UsersImports->primary_phone_number = $request->primary_phone_number ?? '';
                $UsersImports->primary_email = $request->primary_email ?? '';
                $UsersImports->primary_address = $request->primary_address ?? '';
                $UsersImports->primary_organization = $request->primary_organization ?? '';
                $UsersImports->secondary_name = $request->secondary_name ?? '';
                $UsersImports->secondary_phone_number = $request->secondary_phone_number ?? '';
                $UsersImports->secondary_email = $request->secondary_email ?? '';
                $UsersImports->secondary_address = $request->secondary_address ?? '';
                $UsersImports->secondary_designation = $request->secondary_designation ?? '';
                $UsersImports->location = '';
                $UsersImports->region = '';
                $UsersImports->industry = '';
                $UsersImports->engagement_level = '';
                $UsersImports->revenue_booked_to_date = '';
                $UsersImports->referred_by = '';
                $UsersImports->pain_points = '';
                $UsersImports->notes = '';
                $UsersImports->status = '';
                $UsersImports->created_by = \Auth::user()->creatorId();
                $UsersImports->save();
            } else {
                $UsersImports = UserImport::find($request->existing_client);
                if ($UsersImports) {
                    $UsersImports->lead_id = $lastInsertedId;
                    $UsersImports->save();
                }
            }


            // code or MasterCustomer
            $existingcustomer = MasterCustomer::where('email', $lead->primary_email)->first();
            if (!$existingcustomer) {
                $customer = new MasterCustomer();
                $customer->ref_id = $lead->id;
                $customer->name = $request->primary_name;
                $customer->email = $request->primary_email ?? '';
                $customer->phone = $request->primary_phone_number;
                $customer->address = $request->primary_address ?? '';
                $customer->category = 'lead';
                $customer->type = '';
                $customer->save();
            }

            $uArr = [
                'lead_name' => $lead->opportunity_name,
                'lead_email' => $lead->primary_email,
            ];

            $resp = Utility::sendEmailTemplate('lead_assign', [$lead->id => $lead->primary_email], $uArr);

            //webhook
            $module = 'New Lead';
            $Assign_user_phone = User::where('id', \Auth::user()->id)->first();
            $setting  = Utility::settings(\Auth::user()->creatorId());
            $uArr = [
                'lead_name' => $lead->opportunity_name,
                'lead_email' => $lead->primary_email,
            ];
            if (isset($setting['twilio_lead_create']) && $setting['twilio_lead_create'] == 1) {
                $uArr = [
                    'lead_email' => $lead->primary_name,
                    'lead_name' => $lead->opportunity_name
                ];
                Utility::send_twilio_msg($Assign_user_phone->primary_contact, 'new_lead', $uArr);
            }

            $url = 'https://fcm.googleapis.com/fcm/send';
            $FcmToken = User::where('type', 'owner')->orwhere('type', 'admin')->pluck('device_key')->first();
            $serverKey = 'AAAAn2kzNnQ:APA91bE68d4g8vqGKVWcmlM1bDvfvwOIvBl-S-KUNB5n_p4XEAcxUqtXsSg8TkexMR8fcJHCZxucADqim2QTxK2s_P0j5yuy6OBRHVFs_BfUE0B4xqgRCkVi86b8SwBYT953dE3X0wdY'; // ADD SERVER KEY HERE PROVIDED BY FCM
            $data = [
                "to" => $FcmToken,
                "notification" => [
                    "title" => 'Lead created.',
                    "body" => 'New Lead is Created',
                ]
            ];

            $encodedData = json_encode($data);
            $headers = [
                'Authorization:key=' . $serverKey,
                'Content-Type: application/json',
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
            $result = curl_exec($ch);

            // echo "<pre>";
            // print_r($result);
            // die;

            if ($result === FALSE) {
                die('Curl failed: ' . curl_error($ch));
            }
            curl_close($ch);

            return redirect()->back()->with('success', __('Opportunity Created.'));
        } else {
            return redirect()->back()->with('error', 'permission Denied');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Lead $lead
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Lead $lead)
    {
        if (\Auth::user()->can('Show Opportunity')) {
            $settings = Utility::settings();
            $venue = explode(',', $settings['venue']);
            $fixed_cost = json_decode($settings['fixed_billing'], true);
            $additional_items = json_decode($settings['additional_items'], true);
            return view('lead.view', compact('lead', 'venue', 'fixed_cost', 'additional_items'));
        } else {
            return redirect()->back()->with('error', 'permission Denied');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Lead $lead
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Lead $lead)
    {
        // echo "<pre>";
        // print_r($lead);
        // die;

        if (\Auth::user()->can('Edit Opportunity')) {
            $venue_function = explode(',', $lead->venue_selection);
            $function_package =  explode(',', $lead->function);
            $status   = Lead::$status;
            $users     = User::where('created_by', \Auth::user()->creatorId())->get();

            if ($lead) {
                $import_user = UserImport::where('id', $lead->user_id)->first();
                if ($import_user) {
                    $client_name = $import_user->company_name;
                } else {
                    $client_name = $lead->company_name;
                }
            }

            $lead->products = json_decode($lead->products, true);
            $lead->product_details = json_decode($lead->product_details, true);

            // Decode the JSON strings
            // $proudcts = json_decode($lead['products'], true);
            // $hardware_one_time = json_decode($lead['hardware_one_time'], true);
            // $hardware_maintenance = json_decode($lead['hardware_maintenance'], true);
            // $software_recurring = json_decode($lead['software_recurring'], true);
            // $software_one_time = json_decode($lead['software_one_time'], true);
            // $systems_integrations = json_decode($lead['systems_integrations'], true);
            // $subscriptions = json_decode($lead['subscriptions'], true);
            // $tech_deployment_volume_based = json_decode($lead['tech_deployment_volume_based'], true);

            // echo "<pre>";
            // print_r($lead);
            // die;

            return view('lead.edit', compact('venue_function', 'function_package', 'lead', 'users', 'status', 'client_name'));
        } else {
            return redirect()->back()->with('error', 'permission Denied');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Lead $lead
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lead $lead)
    {
        // echo "<pre>";
        // print_r($request->all());
        // die;

        if (\Auth::user()->can('Edit Opportunity')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'lead_name' => 'required',
                    'primary_name' => 'required',
                    'primary_contact' => 'required',
                    'primary_email' => 'required',
                    'primary_address' => 'required',
                    'primary_organization' => 'required',
                    'assign_staff' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first())
                    ->withErrors($validator)
                    ->withInput();
            }

            $formData = json_decode($request->input('formData'), true);

            // New code for update
            $lead['user_id'] = $request->client_id  ?? '';
            $lead['opportunity_name'] = $request->lead_name;
            $lead['assigned_user'] = $request->assign_staff;
            $lead['primary_name'] = $request->primary_name;
            $lead['primary_email'] = $request->primary_email;
            $lead['primary_contact'] = $request->primary_contact;
            $lead['primary_address'] = $request->primary_address;
            $lead['primary_organization'] = $request->primary_organization;
            $lead['secondary_name'] = $request->secondary_name ?? '';
            $lead['secondary_email'] = $request->secondary_email ?? '';
            $lead['secondary_contact'] = $request->secondary_phone_number ?? '';
            $lead['secondary_address'] = $request->secondary_address ?? '';
            $lead['secondary_designation'] = $request->secondary_designation ?? '';
            $lead['region'] = $request->region ?? $request->existing_region;
            $lead['lead_address'] = '-';
            $lead['company_name'] = $request->client_name;
            $lead['relationship'] = '-';
            $lead['start_date'] = '-';
            $lead['end_date'] = '-';
            $lead['type'] = '-';
            $lead['sales_stage'] = $request->sales_stage ?? '';
            $lead['value_of_opportunity'] = $request->value_of_opportunity ?? '';
            $lead['func_package'] = '-';
            $lead['guest_count'] = '-';
            $lead['description'] = '-';
            $lead['deal_length'] = $request->deal_length ?? '';
            $lead['difficult_level'] = $request->difficult_level ?? '';
            $lead['start_time'] = '';
            $lead['end_time'] = '';
            $lead['timing_close'] = $request->timing_close ?? '';
            $lead['bar_package'] = '-';
            $lead['probability_to_close'] = $request->probability_to_close ?? '';
            $lead['currency'] = $request->currency ?? '';
            $lead['lead_status'] = ($request->is_active == 'on') ? 1 : 0;
            $lead['category'] = $request->category ?? '';
            $lead['sales_subcategory'] = $request->sales_subcategory ?? '';
            $lead['competitor'] = $request->competitor ?? '';
            $lead['products'] = json_encode(array_keys($formData)) ?? '';
            $lead['product_details'] = json_encode($formData);
            $lead['hardware_one_time'] = '';
            $lead['hardware_maintenance'] = '';
            $lead['software_recurring'] = '';
            $lead['software_one_time'] = '';
            $lead['systems_integrations'] = '';
            $lead['subscriptions'] = '';
            $lead['tech_deployment_volume_based'] = '';
            $lead['created_by'] = \Auth::user()->id;
            $lead->update();

            $statuss = Lead::$stat;
            if (\Auth::user()->type == 'owner') {
                $leads = Lead::with('accounts', 'assign_user')->where('created_by', \Auth::user()->creatorId())->orderby('id', 'desc')->get();
            } else {
                $leads = Lead::with('accounts', 'assign_user')->where('user_id', \Auth::user()->id)->get();
            }
            return redirect()->route('lead.index', compact('leads', 'statuss'))->with('success', __('Opportunity successfully updated!'));
        } else {
            return redirect()->back()->with('error', 'permission Denied');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Lead $lead
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lead $lead)
    {
        if (\Auth::user()->can('Delete Opportunity')) {
            $lead->delete();
            return redirect()->back()->with('success', __('Opportunity  Deleted.'));
        } else {
            return redirect()->back()->with('error', 'permission Denied');
        }
    }

    public function grid()
    {
        $leads   = Lead::where('created_by', '=', \Auth::user()->creatorId())->get();
        $statuss = Lead::where('created_by', '=', \Auth::user()->creatorId())->get();

        // if($leads->isNotEmpty())
        // {
        //     $users = user::where('id', $leads[0]->user_id)->get();
        // }

        $defualtView         = new UserDefualtView();
        $defualtView->route  = \Request::route()->getName();
        $defualtView->module = 'lead';
        $defualtView->view   = 'kanban';
        User::userDefualtView($defualtView);
        // if($leads->isEmpty())
        // {
        //     return view('lead.grid', compact( 'statuss'));
        // }
        // else
        // {
        //      return view('lead.grid', compact('leads', 'statuss','users'));
        // }
        return view('lead.grid', compact('leads', 'statuss'));
    }

    public function changeorder(Request $request)
    {
        $post   = $request->all();
        $lead   = Lead::find($post['lead_id']);
        $status = Lead::where('status', $post['status_id'])->get();


        if (!empty($status)) {
            $lead->status = $post['status_id'];
            $lead->save();
        }

        foreach ($post['order'] as $key => $item) {
            $order         = Lead::find($item);
            $order->status = $post['status_id'];
            $order->save();
        }
    }

    public function showConvertToAccount($id)
    {
        if (\Auth::user()->type == 'owner') {
            $lead        = Lead::findOrFail($id);
            $accountype  = accountType::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $industry    = accountIndustry::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $user        = User::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $document_id = Document::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');

            return view('lead.convert', compact('lead', 'accountype', 'industry', 'user', 'document_id'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    public function convertToAccount($id, Request $request)
    {
        if (\Auth::user()->type == 'owner') {
            $lead = Lead::findOrFail($id);
            $usr  = \Auth::user();

            $validator = \Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'email' => 'required|email|unique:accounts,email',
                    'shipping_postalcode' => 'required',
                    'lead_postalcode' => 'required',
                ]
            );

            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $account = new account();
            $account['user_id'] = $request->user;
            $account['document_id'] = $request->document_id;
            $account['name'] = $request->name;
            $account['email'] = $request->email;
            $account['primary_contact'] = $request->primary_contact;
            $account['secondary_contact'] = $request->secondary_contact;
            $account['website'] = $request->website;
            $account['billing_address'] = $request->lead_address;
            $account['billing_city'] = $request->lead_city;
            $account['billing_state'] = $request->lead_state;
            $account['billing_country'] = $request->lead_country;
            $account['billing_postalcode'] = $request->lead_postalcode;
            $account['shipping_address'] = $request->shipping_address;
            $account['shipping_city'] = $request->shipping_city;
            $account['shipping_state'] = $request->shipping_state;
            $account['shipping_country'] = $request->shipping_country;
            $account['shipping_postalcode'] = $request->shipping_postalcode;
            $account['type'] = $request->type;
            $account['industry'] = $request->industry;
            $account['description'] = $request->description;
            $account['created_by'] = \Auth::user()->creatorId();
            $account->save();
            // end create deal

            // Update is_converted field as deal_id
            $lead->is_converted = $account->id;
            $lead->save();

            return redirect()->back()->with('success', __('Opportunity converted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    public function proposal($id)
    {
        $decryptedId = decrypt(urldecode($id));
        $proposal_info = Proposal::where('lead_id', $decryptedId)->orderby('id', 'desc')->get();
        return view('lead.proposal_information', compact('proposal_info', 'decryptedId'));
    }
    public function view_proposal($id)
    {
        $auth = auth()->user();
        $decryptedId = decrypt(urldecode($id));
        $lead = Lead::find($decryptedId);
        $settings = Utility::settings();
        if (isset($settings['fixed_billing'])) {
            $fixed_cost = json_decode($settings['fixed_billing'], true);
        }
        $additional_items = json_decode($settings['additional_items'], true);
        $proposal = Proposal::where('lead_id', $decryptedId)->first();
        $data = [
            'settings' => $settings,
            'auth' => $auth,
            'proposal' => $proposal,
            'lead' => $lead,
            'fixed_cost' => $fixed_cost,
            'additional_items' => $additional_items
        ];

        $pdf = Pdf::loadView('lead.signed_proposal', $data);
        // return $pdf->stream('proposal.pdf');
        return response($pdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="proposal.pdf"');
    }
    public function share_proposal_view($id)
    {
        $decryptedId = decrypt(urldecode($id));
        $lead = Lead::find($decryptedId);
        return view('lead.share_proposal', compact('lead'));
    }

    public function send_email_view($id)
    {
        $decryptedId = decrypt(urldecode($id));
        $lead = Lead::find($decryptedId);
        return view('lead.send_email', compact('lead'));
    }

    public function send_email_pdf(Request $request, $id)
    {
        $settings = Utility::settings();
        $id = decrypt(urldecode($id));
        $lead = Lead::find($id);
        if (!empty($request->file('attachment'))) {
            $file =  $request->file('attachment');
            $filename = Str::random(3) . '_' . $file->getClientOriginalName();
            $folder = 'Proposal_attachments/' . $id;
            try {
                $path = $file->storeAs($folder, $filename, 'public');
            } catch (\Exception $e) {
                Log::error('File upload failed: ' . $e->getMessage());
                return redirect()->back()->with('error', 'File upload failed');
            }
        }
        $proposalinfo = new ProposalInfo();
        $proposalinfo->lead_id = $id;
        $proposalinfo->email = $request->email;
        $proposalinfo->subject = $request->subject;
        $proposalinfo->content = $request->emailbody;
        $proposalinfo->proposal_info = '';
        $proposalinfo->attachments = $filename ?? '';
        $proposalinfo->created_by = Auth::user()->id;
        $proposalinfo->save();
        $propid = $proposalinfo->id;
        $subject = $request->subject;
        $content = $request->emailbody;
        try {
            config(
                [
                    'mail.driver'       => $settings['mail_driver'],
                    'mail.host'         => $settings['mail_host'],
                    'mail.port'         => $settings['mail_port'],
                    'mail.username'     => $settings['mail_username'],
                    'mail.password'     => $settings['mail_password'],
                    'mail.from.address' => $settings['mail_from_address'],
                    'mail.from.name'    => $settings['mail_from_name'],
                ]
            );
            Mail::to($request->email)->send(new SendOpportunityEmail($lead, $subject, $content, $proposalinfo, $propid));
            // Lead::where('id', $id)->update(['status' => 1]);
        } catch (\Exception $e) {
            return redirect()->back()->with('success', 'Email Not Sent');
        }
        return redirect()->back()->with('success', 'Email Sent Successfully');
    }

    public function share_nda_view($id)
    {
        $decryptedId = decrypt(urldecode($id));
        $lead = Lead::find($decryptedId);
        return view('lead.share_nda', compact('lead'));
    }

    public function proposalpdf(Request $request, $id)
    {
        $settings = Utility::settings();
        $id = decrypt(urldecode($id));
        $lead = Lead::find($id);
        if (!empty($request->file('attachment'))) {
            $file =  $request->file('attachment');
            $filename = Str::random(3) . '_' . $file->getClientOriginalName();
            $folder = 'Proposal_attachments/' . $id;
            try {
                $path = $file->storeAs($folder, $filename, 'public');
            } catch (\Exception $e) {
                Log::error('File upload failed: ' . $e->getMessage());
                return redirect()->back()->with('error', 'File upload failed');
            }
        }
        $proposalinfo = new ProposalInfo();
        $proposalinfo->lead_id = $id;
        $proposalinfo->email = $request->email;
        $proposalinfo->subject = $request->subject;
        $proposalinfo->content = $request->emailbody;
        $proposalinfo->proposal_info = json_encode($request->billing, true);
        $proposalinfo->attachments = $filename ?? '';
        $proposalinfo->created_by = Auth::user()->id;
        $proposalinfo->save();
        $propid = $proposalinfo->id;
        $subject = $request->subject;
        $content = $request->emailbody;
        try {
            config(
                [
                    'mail.driver'       => $settings['mail_driver'],
                    'mail.host'         => $settings['mail_host'],
                    'mail.port'         => $settings['mail_port'],
                    'mail.username'     => $settings['mail_username'],
                    'mail.password'     => $settings['mail_password'],
                    'mail.from.address' => $settings['mail_from_address'],
                    'mail.from.name'    => $settings['mail_from_name'],
                ]
            );
            Mail::to($request->email)->send(new SendPdfEmail($lead, $subject, $content, $proposalinfo, $propid));
            $upd = Lead::where('id', $id)->update(['status' => 1]);
        } catch (\Exception $e) {
            //   return response()->json(
            //             [
            //                 'is_success' => false,
            //                 'message' => $e->getMessage(),
            //             ]
            //         );
            return redirect()->back()->with('success', 'Email Not Sent');
        }
        return redirect()->back()->with('success', 'Email Sent Successfully');
    }

    public function ndapdf(Request $request, $id)
    {
        $settings = Utility::settings();
        $id = decrypt(urldecode($id));
        $lead = Lead::find($id);
        if (!empty($request->file('attachment'))) {
            $file =  $request->file('attachment');
            $filename = Str::random(3) . '_' . $file->getClientOriginalName();
            $folder = 'Proposal_attachments/' . $id;
            try {
                $path = $file->storeAs($folder, $filename, 'public');
            } catch (\Exception $e) {
                Log::error('File upload failed: ' . $e->getMessage());
                return redirect()->back()->with('error', 'File upload failed');
            }
        }

        $dataInfo = [
            'aggrement_day' => $request->aggrement_day,
            'aggrement_by' => $request->aggrement_by,
            'aggrement_receiving_party' => $request->aggrement_receiving_party,
            'aggrement_transaction' => $request->aggrement_transaction,
            'disclosing_by' => $request->disclosing_by,
            'disclosing_party_name' => $request->disclosing_party_name,
            'disclosing_party_title' => $request->disclosing_party_title
        ];

        $proposalinfo = new ProposalInfo();
        $proposalinfo->lead_id = $id;
        $proposalinfo->email = $request->email;
        $proposalinfo->subject = $request->subject;
        $proposalinfo->content = $request->emailbody;
        $proposalinfo->proposal_info = json_encode($dataInfo, true);
        $proposalinfo->attachments = $filename ?? '';
        $proposalinfo->created_by = Auth::user()->id;
        $proposalinfo->save();
        $propid = $proposalinfo->id;
        $subject = $request->subject;
        $content = $request->emailbody;

        try {
            config(
                [
                    'mail.driver'       => $settings['mail_driver'],
                    'mail.host'         => $settings['mail_host'],
                    'mail.port'         => $settings['mail_port'],
                    'mail.username'     => $settings['mail_username'],
                    'mail.password'     => $settings['mail_password'],
                    'mail.from.address' => $settings['mail_from_address'],
                    'mail.from.name'    => $settings['mail_from_name'],
                ]
            );
            Mail::to($request->email)->send(new SendNdaEmail($lead, $subject, $content, $proposalinfo, $propid));
            $update = Lead::where('id', $id)->update(['status' => 1]);
        } catch (\Exception $e) {
            return redirect()->back()->with('success', 'Email Not Sent');
        }
        return redirect()->back()->with('success', 'Email Sent Successfully');
    }
    public function proposalview($id)
    {
        $id = decrypt(urldecode($id));
        $lead = Lead::find($id);
        $users = User::find($lead->user_id);
        $settings = Utility::settings();
        $venue = explode(',', $settings['venue']);
        $fixed_cost = json_decode($settings['fixed_billing'], true);
        $additional_items = json_decode($settings['additional_items'], true);
        return view('lead.proposal', compact('lead', 'venue', 'settings', 'fixed_cost', 'additional_items', 'users'));
    }

    // public function ndaview($id)
    // {
    //     $id = decrypt(urldecode($id));
    //     $lead = Lead::find($id);
    //     $users = User::find($lead->user_id);
    //     $settings = Utility::settings();
    //     return view('lead.nda', compact('lead', 'settings', 'users'));
    // }

    public function ndaview($id)
    {
        // $id = decrypt(urldecode($id));

        $lead = Lead::find($id);
        $users = User::find($lead->user_id);
        $settings = Utility::settings();

        return view('lead.nda', compact('lead', 'settings', 'users'));
    }


    public function proposal_resp(Request $request, $id)
    {
        $settings = Utility::settings();
        $id = decrypt(urldecode($id));

        $agreement = html_entity_decode($request->agreement);
        $remarks = html_entity_decode($request->remarks);


        if (!empty($request->imageData)) {
            $image = $this->uploadSignature($request->imageData);
        } else {
            return redirect()->back()->with('error', ('Please Sign it for confirmation'));
        }

        $existproposal = Proposal::where('lead_id', $id)->exists();
        // if ($existproposal == TRUE) {
        //     Proposal::where('lead_id',$id)->update(['image' => $image]);
        //     return redirect()->back()->with('error','Proposal is already confirmed');
        // }
        $proposals = new Proposal();

        $proposals['lead_id'] = $id;
        $proposals['image'] = $image;
        $proposals['notes'] = $request->comments;
        $proposals['agreement'] = $agreement;
        $proposals['remarks'] = $remarks;
        $proposals['name'] = $request->name;
        $proposals['designation'] = $request->designation;
        $proposals['date'] = $request->date;
        $proposals['to_name'] = $request->to_name;
        $proposals['to_designation'] = $request->to_designation;
        $proposals['to_date'] = $request->to_date;
        $proposals['proposal_id'] = isset($request->proposal) && ($request->proposal != '') ? $request->proposal : '';
        // $proposals->save();
        $lead = Lead::find($id);
        $users = User::where('type', 'owner')->orwhere('type', 'Admin')->get();

        $usersDetail = User::find($lead->user_id);

        // die;
        $fixed_cost = json_decode($settings['fixed_billing'], true);
        $additional_items = json_decode($settings['additional_items'], true);
        $data = [
            'proposal' => $proposals,
            'lead' => $lead,
            'usersDetail' => $usersDetail,
            'fixed_cost' => $fixed_cost,
            'settings' => $settings,
            'additional_items' => $additional_items
        ];
        $pdf = Pdf::loadView('lead.signed_proposal', $data);

        try {
            $filename = 'proposal_' . time() . '.pdf'; // You can adjust the filename as needed
            $folder = 'Proposal_response/' . $id;
            $path = Storage::disk('public')->put($folder . '/' . $filename, $pdf->output());
            $proposals->update(['proposal_response' => $filename]);
        } catch (\Exception $e) {
            // Log the error for future reference
            \Log::error('File upload failed: ' . $e->getMessage());
            // Return an error response
            return response()->json([
                'is_success' => false,
                'message' => 'Failed to save PDF: ' . $e->getMessage(),
            ]);
        }
        /* try {
            config(
                [
                    'mail.driver'       => $settings['mail_driver'],
                    'mail.host'         => $settings['mail_host'],
                    'mail.port'         => $settings['mail_port'],
                    'mail.username'     => $settings['mail_username'],
                    'mail.password'     => $settings['mail_password'],
                    'mail.from.address' => $settings['mail_from_address'],
                    'mail.from.name'    => $settings['mail_from_name'],
                ]
            );
            foreach ($users as  $user) {
                Mail::to($lead->email)->cc($user->email)
                    ->send(new ProposalResponseMail($proposals, $lead));
            }
            $upd = Lead::where('id', $id)->update(['status' => 2]);
        } catch (\Exception $e) {
            //   return response()->json(
            //             [
            //                 'is_success' => false,
            //                 'message' => $e->getMessage(),
            //             ]
            //         );
            return redirect()->back()->with('success', 'Email Not Sent');
        } */
        return $pdf->stream('proposal.pdf');
    }


    public function nda_resp(Request $request, $id)
    {
        // Decrypt and decode the ID
        $id = decrypt(urldecode($id));
        $lead = Lead::find($id);

        if ($lead) {
            $lead->is_nda_signed = 1;
            $lead->status = 6;
            $lead->save();
        } else {
            return redirect()->back()->with('error', 'Invalid Opportunity');
        }

        if (!empty($request->imageData)) {
            $image = $this->uploadSignature($request->imageData);
        } else {
            return redirect()->back()->with('error', 'Please Sign the document for confirmation.');
        }

        if (empty($request->receiving_by) && empty($request->receiving_name) && empty($request->receiving_title)) {
            return redirect()->back()->with('error', 'Please fill the Receiving Party information for confirmation.');
        }

        // Insert data into the database
        $ndaResponse = new Nda();
        $ndaResponse->user_id = $lead->user_id;
        $ndaResponse->lead_id = $id;
        $ndaResponse->aggrement_day = $request->aggrement_day;
        $ndaResponse->aggrement_by = $request->aggrement_by;
        $ndaResponse->aggrement_receiving_party = $request->aggrement_receiving_party;
        $ndaResponse->aggrement_transaction = $request->aggrement_transaction;
        $ndaResponse->disclosing_by = $request->disclosing_by;
        $ndaResponse->disclosing_name = $request->disclosing_name;
        $ndaResponse->disclosing_title = $request->disclosing_title;
        $ndaResponse->receiving_by = $request->receiving_by;
        $ndaResponse->receiving_name = $request->receiving_name;
        $ndaResponse->receiving_title = $request->receiving_title;
        $ndaResponse->image = $image;
        $ndaResponse->nda_response = '';
        $ndaResponse->created_at = now();
        $ndaResponse->updated_at = now();
        $ndaResponse->save();

        $data = [
            'nda' => $ndaResponse,
        ];

        $pdf = Pdf::loadView('lead.signed_nda', $data);

        try {
            $filename = 'proposal_' . time() . '.pdf';
            $folder = 'Proposal_response/' . $id;
            $path = Storage::disk('public')->put($folder . '/' . $filename, $pdf->output());
            $ndaResponse->update(['nda_response' => $filename]);
        } catch (\Exception $e) {
            \Log::error('File upload failed: ' . $e->getMessage());
            return response()->json([
                'is_success' => false,
                'message' => 'Failed to save PDF: ' . $e->getMessage(),
            ]);
        }
        return $pdf->stream('proposal.pdf');
    }

    public function uploadSignature($signed)
    {
        $folderPath = public_path('upload/');
        $image_parts = explode(";base64,", $signed);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = $folderPath . uniqid() . '.' . $image_type;
        file_put_contents($file, $image_base64);
        return $file;
    }
    public function review_proposal($id)
    {

        $id = decrypt(urldecode($id));
        $lead = Lead::find($id);
        if ($lead) {
            $import_user = UserImport::where('id', $lead->user_id)->first();
            if ($import_user) {
                $client_name = $import_user->company_name;
            } else {
                $client_name = $lead->company_name;
            }
        }

        // Decode the JSON strings
        // $hardware_one_time = json_decode($lead['hardware_one_time'], true);
        // $hardware_maintenance = json_decode($lead['hardware_maintenance'], true);
        // $software_recurring = json_decode($lead['software_recurring'], true);
        // $software_one_time = json_decode($lead['software_one_time'], true);
        // $systems_integrations = json_decode($lead['systems_integrations'], true);
        // $subscriptions = json_decode($lead['subscriptions'], true);
        // $tech_deployment_volume_based = json_decode($lead['tech_deployment_volume_based'], true);

        // echo "<pre>";
        // print_r($software_one_time);
        // die;

        $lead->products = json_decode($lead->products, true);
        $lead->product_details = json_decode($lead->product_details, true);

        // echo "<pre>";
        // print_r($lead);
        // die;

        $venue_function = explode(',', $lead->venue_selection);
        $function_package =  explode(',', $lead->function);
        $status   = Lead::$status;
        $users     = User::where('created_by', \Auth::user()->creatorId())->get();
        return view('lead.review_proposal', compact('lead', 'venue_function', 'function_package', 'users', 'status', 'client_name'));
    }
    public function review_proposal_data(Request $request, $id)
    {
        // echo "<pre>";
        // print_r($request->all());
        // die;

        $settings = Utility::settings();
        $validator = \Validator::make($request->all(), [
            // 'status' => 'required|in:Approve,Resend,Withdraw',
        ], [
            // 'status.in' => 'The status field is required',
        ]);
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }

        $formData = json_decode($request->input('formData'), true);

        $lead = Lead::find($id);
        // if ($request->status == 'Approve') {
        //     $status = 4;         
        // } elseif ($request->status == 'Resend') {
        //     $status = 5;      
        // } elseif ($request->status == 'Withdraw') {
        //     $status = 3;        
        // }

        $data = [
            // 'user_id' => $request->user,
            'user_id' => $request->client_name ?? '',
            'opportunity_name' => $request->lead_name,
            'assigned_user' => $request->assign_staff,
            'primary_name' => $request->primary_name,
            'primary_email' => $request->primary_email,
            'primary_contact' => $request->primary_phone_number,
            'primary_address' => $request->primary_address,
            'primary_organization' => $request->primary_organization,
            'secondary_name' => $request->secondary_name ?? '',
            'secondary_email' => $request->secondary_email ?? '',
            'secondary_contact' => $request->secondary_phone_number ?? '',
            'company_name' => $request->client_name ?? '',
            'secondary_address' => $request->secondary_address ?? '',
            'secondary_designation' => $request->secondary_designation ?? '',
            'region' => $request->region ?? $request->existing_region,
            'sales_stage' => $request->sales_stage ?? '',
            'value_of_opportunity' => $request->value_of_opportunity ?? '',
            'deal_length' => $request->deal_length ?? '',
            'difficult_level' => $request->difficult_level ?? '',
            'start_time' => $request->start_time ?? '',
            'end_time' => $request->end_time ?? '',
            'timing_close' => $request->timing_close ?? '',
            'probability_to_close' => $request->probability_to_close ?? '',
            'currency' => $request->currency ?? '',
            'lead_status' => ($request->is_active == 'on') ? 1 : 0,
            'category' => $request->category ?? '',
            'sales_subcategory' => $request->sales_subcategory ?? '',
            'competitor' => $request->competitor ?? '',
            'products' => json_encode(array_keys($formData)) ?? '',
            'product_details' => json_encode($formData),
            'hardware_one_time' => '',
            'hardware_maintenance' => '',
            'software_recurring' => '',
            'software_one_time' => '',
            'systems_integrations' => '',
            'subscriptions' => '',
            'tech_deployment_volume_based' => '',
            'created_by' => \Auth::user()->id,
        ];

        $lead->update($data);

        // echo "<pre>";
        // print_r($data);
        // die;

        // $statuss = Lead::$stat;
        // if (\Auth::user()->type == 'owner') {
        //     $leads = Lead::with('accounts', 'assign_user')->where('created_by', \Auth::user()->creatorId())->orderby('id', 'desc')->get();
        // } else {
        //     $leads = Lead::with('accounts', 'assign_user')->where('user_id', \Auth::user()->id)->get();
        // }
        // if ($status == 4) {
        //     return redirect()->route('lead.index', compact('leads', 'statuss'))->with('success', __('Opportunity Approved!'));
        // } elseif ($status == 3) {
        //     Proposal::where('lead_id', $id)->delete();
        //     try {
        //         config(
        //             [
        //                 'mail.driver'       => $settings['mail_driver'],
        //                 'mail.host'         => $settings['mail_host'],
        //                 'mail.port'         => $settings['mail_port'],
        //                 'mail.username'     => $settings['mail_username'],
        //                 'mail.password'     => $settings['mail_password'],
        //                 'mail.from.address' => $settings['mail_from_address'],
        //                 'mail.from.name'    => $settings['mail_from_name']
        //             ]
        //         );
        //         Mail::to($lead->email)->send(new LeadWithrawMail($lead));
        //     } catch (\Exception $e) {
        //         // return response()->json(
        //         //     [
        //         //         'is_success' => false,
        //         //         'message' => $e->getMessage(),
        //         //     ]
        //         // );
        //         return redirect()->route('lead.index', compact('leads', 'statuss'))->with('danger', __('Email Not Sent!'));
        //     }
        //     return redirect()->route('lead.index', compact('leads', 'statuss'))->with('danger', __('Opportunity Withdrawn!'));
        // } elseif ($status == 5) {
        //     $subject = 'Lead Details';
        //     $content = '';
        //     $proposalinfo = ProposalInfo::where('lead_id', $id)->orderby('id', 'desc')->first();
        //     $propid = $proposalinfo->id;
        //     try {
        //         config(
        //             [
        //                 'mail.driver'       => $settings['mail_driver'],
        //                 'mail.host'         => $settings['mail_host'],
        //                 'mail.port'         => $settings['mail_port'],
        //                 'mail.username'     => $settings['mail_username'],
        //                 'mail.password'     => $settings['mail_password'],
        //                 'mail.from.address' => $settings['mail_from_address'],
        //                 'mail.from.name'    => $settings['mail_from_name'],
        //             ]
        //         );
        //         Mail::to($request->email)->send(new SendPdfEmail($lead, $subject, $content, $proposalinfo, $propid));
        //         // Mail::to($request->email)->send(new SendPdfEmail($lead,$subject,$content,$tempFilePath = NULL));
        //         // unlink($tempFilePath);
        //         // $upd = Lead::where('id',$id)->update(['status' => 1]);
        //     } catch (\Exception $e) {
        //         //   return response()->json(
        //         //             [
        //         //                 'is_success' => false,
        //         //                 'message' => $e->getMessage(),
        //         //             ]
        //         //         );
        //         return redirect()->route('lead.index', compact('leads', 'statuss'))->with('danger', __('Email Not Sent!'));
        //     }
        //     return redirect()->route('lead.index', compact('leads', 'statuss'))->with('danger', __('Opportunity Resent!'));
        // }
        return redirect()->route('lead.index')->with('success', __('Opportunity Updated Successfully!'));
    }
    public function duplicate($id)
    {

        $id = decrypt(urldecode($id));
        $lead = Lead::find($id);
        $newlead = new Lead();

        // $newlead['user_id'] = Auth::user()->id;
        // $newlead['name'] = $lead->name;
        // $newlead['leadname'] =  $lead->leadname;
        // $newlead['assigned_user'] = $lead->user_id;
        // $newlead['start_date'] = date('Y-m-d');
        // $newlead['end_date'] = date('Y-m-d');
        // $newlead['email'] = $lead->email;
        // $newlead['primary_contact'] = $lead->primary_contact;
        // $newlead['secondary_contact'] = $lead->secondary_contact;
        // $newlead['lead_address'] = $lead->lead_address;
        // $newlead['company_name'] = $lead->company_name;
        // $newlead['relationship'] = $lead->relationship;
        // $newlead['created_by'] = \Auth::user()->creatorId();
        // $newlead->save();

        $newlead['user_id'] = $lead->existing_client  ?? '';
        $newlead['opportunity_name'] = $lead->opportunity_name;
        $newlead['assigned_user'] = $lead->assign_staff ?? '';
        $newlead['primary_name'] = $lead->primary_name;
        $newlead['primary_email'] = $lead->primary_email;
        $newlead['primary_contact'] = $lead->primary_phone_number;
        $newlead['primary_address'] = $lead->primary_address;
        $newlead['primary_organization'] = $lead->primary_organization;
        $newlead['secondary_name'] = $lead->secondary_name ?? '';
        $newlead['secondary_email'] = $lead->secondary_email ?? '';
        $newlead['secondary_contact'] = $lead->secondary_phone_number ?? '';
        $newlead['secondary_address'] = $lead->secondary_address ?? '';
        $newlead['secondary_designation'] = $lead->secondary_designation ?? '';
        $newlead['region'] = $lead->region ?? $lead->existing_region;
        $newlead['sales_stage'] = $lead->sales_stage ?? '';
        $newlead['value_of_opportunity'] = $lead->value_of_opportunity ?? '';
        $newlead['deal_length'] = $lead->deal_length ?? '';
        $newlead['difficult_level'] = $lead->difficult_level ?? '';
        $newlead['start_time'] = $lead->start_time ?? '';
        $newlead['end_time'] = $lead->end_time ?? '';
        $newlead['timing_close'] = $lead->timing_close ?? '';
        $newlead['probability_to_close'] = $lead->probability_to_close ?? '';
        $newlead['currency'] = $lead->currency ?? '';
        $newlead['status'] = ($lead->is_active == 'on') ? 1 : 0;
        $newlead['category'] = $lead->category ?? '';
        $newlead['sales_subcategory'] = $lead->sales_subcategory ?? '';
        $newlead['competitor'] = $lead->competitor ?? '';
        $newlead['products'] = $lead->products ?? '';
        $newlead['product_details'] = $lead->product_details;
        $newlead['hardware_one_time'] = '';
        $newlead['hardware_maintenance'] = '';
        $newlead['software_recurring'] = '';
        $newlead['software_one_time'] = '';
        $newlead['systems_integrations'] = '';
        $newlead['subscriptions'] = '';
        $newlead['tech_deployment_volume_based'] = '';
        $newlead['created_by'] = \Auth::user()->id;
        $newlead->save();
        return redirect()->back()->with('success', 'Opportunity Cloned successfully');
    }
    public function lead_info($id)
    {
        $id = decrypt(urldecode($id));
        $lead = Lead::find($id);
        if (!empty($lead->email)) {
            $leads = Lead::where('email', $lead->email)->get();
        } else {
            $leads = Lead::where('primary_contact', $lead->primary_contact)->get();
        }

        $client = UserImport::find($id);

        if ($client) {
            $opportunity = $client->lead;
        } else {
            $opportunity = null;
        }

        @$selected_products = json_decode($opportunity->products);

        if ($selected_products) {
            $products = implode(', ', $selected_products);
        } else {
            $products = [];
        }
        $notes = NotesLeads::where('lead_id', $id)->orderby('id', 'desc')->get();
        $docs = LeadDoc::where('lead_id', $id)->get();
        return view('lead.leadinfo', compact('leads', 'lead', 'docs', 'notes', 'opportunity', 'products', 'client'));
    }
    public function lead_user_info($id)
    {

        $id = decrypt(urldecode($id));
        $email = Lead::withTrashed()->find($id)->email;
        $leads = Lead::withTrashed()->where('email', $email)->get();
        $notes = NotesLeads::where('lead_id', $id)->orderby('id', 'desc')->get();
        $docs = LeadDoc::where('lead_id', $id)->get();
        return view('customer.leaduserview', compact('leads', 'docs', 'notes'));
    }
    public function lead_upload($id)
    {
        return view('lead.uploaddoc', compact('id'));
    }
    public function lead_upload_doc(Request $request, $id)
    {
        // echo "<pre>";
        // print_r($request->all());
        // die;

        $validator = \Validator::make(
            $request->all(),
            [
                'lead_file' => 'required|mimes:doc,docx,pdf',
            ]
        );
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }
        $file = $request->file('lead_file');
        if ($file) {
            $originalName = $file->getClientOriginalName();
            $filename = Str::random(4) . '.' . $file->getClientOriginalExtension();
            $folder = 'leadInfo/' . $id; // Example: uploads/1
            try {
                $path = $file->storeAs($folder, $filename, 'public');
            } catch (\Exception $e) {
                Log::error('File upload failed: ' . $e->getMessage());
                return redirect()->back()->with('error', 'File upload failed');
            }
            $document = new LeadDoc();
            $document->lead_id = $id; // Assuming you have a lead_id field
            $document->filename = $originalName; // Store original file name
            $document->filepath = $path; // Store file path
            $document->save();
            return redirect()->back()->with('success', 'Document Uploaded Successfully');
        } else {
            return redirect()->back()->with('error', 'No file uploaded');
        }
    }
    public function lead_billinfo($id)
    {
        return view('lead.bill_information');
    }
    public function uploaded_docs($id)
    {
        $docs = LeadDoc::where('lead_id', $id)->get();
        return view('lead.viewdocument', compact('docs'));
    }
    public function status(Request $request)
    {
        $id = $request->id;
        Lead::where('id', $id)->update([
            'lead_status' => $request->status
        ]);
        return true;
    }
    // public function propstatus(Request $request)
    // {
    //     $id = $request->id;
    //     Lead::where('id', $id)->update([
    //         'status' => $request->status
    //     ]);
    //     return true;
    // }

    public function propstatus(Request $request)
    {

        $id = $request->id;
        $status = $request->status;
        $statusText = $request->status_text;
        $leadName = $request->lead_name;

        // Update lead status
        Lead::where('id', $id)->update(['status' => $status]);

        // Push notification setup
        $url = 'https://fcm.googleapis.com/fcm/send';

        // Get the FcmToken for owner or admin
        $FcmToken = User::whereIn('type', ['owner', 'admin'])->pluck('device_key')->first();
        $serverKey = 'AAAAn2kzNnQ:APA91bE68d4g8vqGKVWcmlM1bDvfvwOIvBl-S-KUNB5n_p4XEAcxUqtXsSg8TkexMR8fcJHCZxucADqim2QTxK2s_P0j5yuy6OBRHVFs_BfUE0B4xqgRCkVi86b8SwBYT953dE3X0wdY'; // ADD SERVER KEY HERE PROVIDED BY FCM

        // Prepare notification data
        $data = [
            "to" => $FcmToken,
            "notification" => [
                "title" => 'Lead status updated.',
                "body" => 'The status of lead ' . $leadName . ' has been updated to ' . $statusText,
            ]
        ];

        $headers = [
            'Authorization: key=' . $serverKey,
            'Content-Type: application/json',
        ];

        // Send push notification using cURL
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $result = curl_exec($ch);

        if ($result === FALSE) {
            \Log::error('Push notification failed: ' . curl_error($ch));
        }

        curl_close($ch);

        return true;
    }

    public function leadnotes(Request $request, $id)
    {
        $notes = new NotesLeads();
        $notes->notes = $request->notes;
        $notes->created_by = $request->createrid;
        $notes->lead_id = $id;
        $notes->save();
        return true;
    }
}

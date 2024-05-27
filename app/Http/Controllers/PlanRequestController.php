<?php

namespace App\Http\Controllers;

use App\Models\plan_request;
use App\Models\Plan;
use App\Models\Order;
use App\Models\User;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->type == 'super admin')
        {
            $plan_requests=plan_request::all();

            return view ('plan_request.index',compact('plan_requests'));
        }
        else
        {
            return redirect()->back()->with('error',__('Permission Denied.'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\plan_request  $plan_request
     * @return \Illuminate\Http\Response
     */
    public function show(plan_request $plan_request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\plan_request  $plan_request
     * @return \Illuminate\Http\Response
     */
    public function edit(plan_request $plan_request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\plan_request  $plan_request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, plan_request $plan_request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\plan_request  $plan_request
     * @return \Illuminate\Http\Response
     */
    public function destroy(plan_request $plan_request)
    {
        //
    }

    public function requestView($plan_id)
    {
        if(Auth::user()->type != 'super admin')
        {
            $planID = \Illuminate\Support\Facades\Crypt::decrypt($plan_id);
            $plan   = Plan::find($planID);

            if(!empty($plan))
            {
                return view('plan_request.show', compact('plan'));
            }
            else
            {
                return redirect()->back()->with('error', __('Something went wrong.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    public function userRequest($plan_id)
    {
        $objUser =Auth::user() ;
        if(Auth::user()->type == 'owner')
        // if($objUser->requested_plan == 0)
    {
        $planID = \Illuminate\Support\Facades\Crypt::decrypt($plan_id);
        $planDuration = Plan::where('id',$planID)->first();


            if(!empty($planID))
            {
                plan_request::create([
                                        'user_id'  => $objUser->id,
                                        'plan_id'  => $planID,
                                        'duration' => $planDuration->duration

                                    ]);

                // Update User Table
                // $objUser->update(['requested_plan' => $planID]);
                $objUser['requested_plan'] = $planID;
                $objUser->update();


                return redirect()->back()->with('success', __('Request Send Successfully.'));
            }
            else
            {
                return redirect()->back()->with('error', __('Something went wrong.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('You already send request to another plan.'));
        }
    }


    public function acceptRequest($id, $response)
    {

            $plan_request = plan_request::find($id);
            if(!empty($plan_request))
            {
                $user = User::find($plan_request->user_id);


                if($response == 1)
                {
                    $user->requested_plan = $plan_request->plan_id;
                    $user->plan           = $plan_request->plan_id;
                    $user->save();

                    $plan       = Plan::find($plan_request->plan_id);
                    $assignPlan = $user->assignPlan($plan_request->plan_id, $plan_request->duration);
                    $price      = $plan->{$plan_request->duration . '_price'};

                    if($assignPlan['is_success'] == true && !empty($plan))
                    {

                         $orderID = strtoupper(str_replace('.', '', uniqid('', true)));
                        Order::create(
                            [
                                'order_id' => $orderID,
                                'name' => null,
                                'card_number' => null,
                                'card_exp_month' => null,
                                'card_exp_year' => null,
                                'plan_name' => $plan->name,
                                'plan_id' => $plan->id,
                                'price' => $plan->price,
                                'price_currency' => Utility::getValByName('site_currency'),
                                'txn_id' => '',
                                'payment_status' => 'succeeded',
                                'receipt' => null,
                                'payment_type' => __('Manually'),
                                'user_id' => $user->id,
                            ]
                        );

                        $plan_request->delete();


                        return redirect()->back()->with('success', __('Plan successfully upgraded.'));
                    }
                    else
                    {
                        return redirect()->back()->with('error', __('Plan fail to upgrade.'));
                    }
                }
                else
                {
                    $user['requested_plan']= '0';
                    $user->update();

                    $plan_request->delete();

                    return redirect()->back()->with('success', __('Request Rejected Successfully.'));
                }
            }
            else
            {
                return redirect()->back()->with('error', __('Something went wrong.'));
            }



    }

     public function cancelRequest($id)
    {

        $user = User::find($id);
        $user['requested_plan'] = '0';
        $user->update();
        plan_request::where('user_id', $id)->delete();

        return redirect()->back()->with('success', __('Request Canceled Successfully.'));
    }



}

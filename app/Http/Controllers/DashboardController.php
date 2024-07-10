<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Call;
use App\Models\CommonCase;
use App\Models\Contact;
use App\Models\Invoice;
use App\Models\Lead;
use App\Models\Meeting;
use App\Models\Opportunities;
use App\Models\Product;
use App\Models\Quote;
use App\Models\SalesOrder;
use App\Models\Task;
use App\Models\User;
use App\Models\Billing;
use App\Models\Order;
use App\Models\Plan;
use App\Models\Utility;
use App\Models\Blockdate;
use App\Models\PaymentLogs;
use App\Models\LandingPageSections;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\In;
use function Symfony\Component\String\s;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{

    public function index()
    {
        if (\Auth::check()) {   
            if (\Auth::user()->type == 'admin' || \Auth::user()->type == 'owner') {
                $setting = Utility::settings();
                $products = explode(',', $setting['product_type']);
                $regions = explode(',', $setting['region']);
                $assinged_staff = User::whereNotIn('id', [1, 3])->get();

                $currency_data = json_decode($setting['currency_conversion'], true);

                // Initialize variables to hold the conversion rates
                $usd = $eur = $gbp = null;

                // Iterate through the array and extract the conversion rates
                foreach ($currency_data as $currency) {
                    switch ($currency['code']) {
                        case 'USD':
                            $usd = $currency['conversion_rate_to_usd'];
                            break;
                        case 'EUR':
                            $eur = $currency['conversion_rate_to_usd'];
                            break;
                        case 'GBP':
                            $gbp = $currency['conversion_rate_to_usd'];
                            break;
                    }
                }

                // Prospecting Opportunities
                $prospectingOpportunities = Lead::where('created_by', \Auth::user()->creatorId())
                    ->where('lead_status', 1)
                    ->whereIn('sales_stage', ['New', 'Contacted'])
                    ->get();


                $prospectingOpportunitiesSum = 0;

                foreach ($prospectingOpportunities as $opportunity) {
                    $valueOfOpportunity = str_replace(',', '', $opportunity->value_of_opportunity);
                    $valueOfOpportunity = (float)$valueOfOpportunity;

                    if ($opportunity->currency == 'GBP') {
                        $convertedValue = $valueOfOpportunity * $gbp;
                    } elseif ($opportunity->currency == 'EUR') {
                        $convertedValue = $valueOfOpportunity * $eur;
                    } else {
                        $convertedValue = $valueOfOpportunity;
                    }

                    $prospectingOpportunitiesSum += $convertedValue;
                }

                $prospectingOpportunitiesCount = $prospectingOpportunities->count();


                // Discovery Opportunities
                $discoveryOpportunities = Lead::where('created_by', \Auth::user()->creatorId())
                    ->where('lead_status', 1)
                    ->whereIn('sales_stage', ['Qualifying', 'Qualified'])
                    ->get();

                $discoveryOpportunitiesSum = 0;

                foreach ($discoveryOpportunities as $opportunity) {
                    $valueOfOpportunity = str_replace(',', '', $opportunity->value_of_opportunity);
                    $valueOfOpportunity = (float)$valueOfOpportunity;

                    if ($opportunity->currency == 'GBP') {
                        $convertedValue = $valueOfOpportunity * $gbp;
                    } elseif ($opportunity->currency == 'EUR') {
                        $convertedValue = $valueOfOpportunity * $eur;
                    } else {
                        $convertedValue = $valueOfOpportunity;
                    }

                    $discoveryOpportunitiesSum += $convertedValue;
                }

                $discoveryOpportunitiesCount = $discoveryOpportunities->count();

                // Demo or Meeting Opportunities
                $demoOrMeetingOpportunities = Lead::where('created_by', \Auth::user()->creatorId())
                    ->where('lead_status', 1)
                    ->whereIn('sales_stage', ['NDA Signed', 'Demo or Meeting'])
                    ->get();


                $demoOrMeetingOpportunitiesSum = 0;

                foreach ($demoOrMeetingOpportunities as $opportunity) {
                    $valueOfOpportunity = str_replace(',', '', $opportunity->value_of_opportunity);
                    $valueOfOpportunity = (float)$valueOfOpportunity;

                    if ($opportunity->currency == 'GBP') {
                        $convertedValue = $valueOfOpportunity * $gbp;
                    } elseif ($opportunity->currency == 'EUR') {
                        $convertedValue = $valueOfOpportunity * $eur;
                    } else {
                        $convertedValue = $valueOfOpportunity;
                    }

                    $demoOrMeetingOpportunitiesSum += $convertedValue;
                }

                $demoOrMeetingOpportunitiesCount = $demoOrMeetingOpportunities->count();

                // Proposal Opportunities
                $proposalOpportunities = Lead::where('created_by', \Auth::user()->creatorId())
                    ->where('lead_status', 1)
                    ->where('sales_stage', 'Proposal')
                    ->get();


                $proposalOpportunitiesSum = 0;

                foreach ($proposalOpportunities as $opportunity) {
                    $valueOfOpportunity = str_replace(',', '', $opportunity->value_of_opportunity);
                    $valueOfOpportunity = (float)$valueOfOpportunity;

                    if ($opportunity->currency == 'GBP') {
                        $convertedValue = $valueOfOpportunity * $gbp;
                    } elseif ($opportunity->currency == 'EUR') {
                        $convertedValue = $valueOfOpportunity * $eur;
                    } else {
                        $convertedValue = $valueOfOpportunity;
                    }

                    $proposalOpportunitiesSum += $convertedValue;
                }

                $proposalOpportunitiesCount = $proposalOpportunities->count();

                // Negotiation Opportunities
                $negotiationOpportunities = Lead::where('created_by', \Auth::user()->creatorId())
                    ->where('lead_status', 1)
                    ->where('sales_stage', 'Negotiation')
                    ->get();

                $negotiationOpportunitiesSum = 0;

                foreach ($negotiationOpportunities as $opportunity) {
                    $valueOfOpportunity = str_replace(',', '', $opportunity->value_of_opportunity);
                    $valueOfOpportunity = (float)$valueOfOpportunity;

                    if ($opportunity->currency == 'GBP') {
                        $convertedValue = $valueOfOpportunity * $gbp;
                    } elseif ($opportunity->currency == 'EUR') {
                        $convertedValue = $valueOfOpportunity * $eur;
                    } else {
                        $convertedValue = $valueOfOpportunity;
                    }

                    $negotiationOpportunitiesSum += $convertedValue;
                }

                $negotiationOpportunitiesCount = $negotiationOpportunities->count();

                // Awaiting Decision Opportunities
                $awaitingDecisionOpportunities = Lead::where('created_by', \Auth::user()->creatorId())
                    ->where('lead_status', 1)
                    ->where('sales_stage', 'Awaiting Decision')
                    ->get();

                $awaitingDecisionOpportunitiesSum = 0;

                foreach ($awaitingDecisionOpportunities as $opportunity) {
                    $valueOfOpportunity = str_replace(',', '', $opportunity->value_of_opportunity);
                    $valueOfOpportunity = (float)$valueOfOpportunity;

                    if ($opportunity->currency == 'GBP') {
                        $convertedValue = $valueOfOpportunity * $gbp;
                    } elseif ($opportunity->currency == 'EUR') {
                        $convertedValue = $valueOfOpportunity * $eur;
                    } else {
                        $convertedValue = $valueOfOpportunity;
                    }

                    $awaitingDecisionOpportunitiesSum += $convertedValue;
                }

                $awaitingDecisionOpportunitiesCount = $awaitingDecisionOpportunities->count();

                // Post Purchase Opportunities
                $postPurchaseOpportunities = Lead::where('created_by', \Auth::user()->creatorId())
                    ->where('lead_status', 1)
                    ->whereIn('sales_stage', ['Implementation', 'Follow-Up Needed'])
                    ->get();

                $postPurchaseOpportunitiesSum = 0;

                foreach ($postPurchaseOpportunities as $opportunity) {
                    $valueOfOpportunity = str_replace(',', '', $opportunity->value_of_opportunity);
                    $valueOfOpportunity = (float)$valueOfOpportunity;

                    if ($opportunity->currency == 'GBP') {
                        $convertedValue = $valueOfOpportunity * $gbp;
                    } elseif ($opportunity->currency == 'EUR') {
                        $convertedValue = $valueOfOpportunity * $eur;
                    } else {
                        $convertedValue = $valueOfOpportunity;
                    }

                    $postPurchaseOpportunitiesSum += $convertedValue;
                }

                $postPurchaseOpportunitiesCount = $postPurchaseOpportunities->count();

                // Closed Won Opportunities
                $closedWonOpportunities = Lead::where('created_by', \Auth::user()->creatorId())
                    ->where('lead_status', 1)
                    ->where('sales_stage', 'Closed Won')
                    ->get();

                $closedWonOpportunitiesSum = 0;

                foreach ($closedWonOpportunities as $opportunity) {
                    $valueOfOpportunity = str_replace(',', '', $opportunity->value_of_opportunity);
                    $valueOfOpportunity = (float)$valueOfOpportunity;

                    if ($opportunity->currency == 'GBP') {
                        $convertedValue = $valueOfOpportunity * $gbp;
                    } elseif ($opportunity->currency == 'EUR') {
                        $convertedValue = $valueOfOpportunity * $eur;
                    } else {
                        $convertedValue = $valueOfOpportunity;
                    }

                    $closedWonOpportunitiesSum += $convertedValue;
                }

                $closedWonOpportunitiesCount = $closedWonOpportunities->count();
                return view('home', compact('assinged_staff', 'products', 'prospectingOpportunities', 'prospectingOpportunitiesCount', 'discoveryOpportunities', 'discoveryOpportunitiesCount', 'demoOrMeetingOpportunities', 'demoOrMeetingOpportunitiesCount', 'proposalOpportunities', 'proposalOpportunitiesCount', 'negotiationOpportunities', 'negotiationOpportunitiesCount', 'awaitingDecisionOpportunities', 'awaitingDecisionOpportunitiesCount', 'postPurchaseOpportunities', 'postPurchaseOpportunitiesCount', 'closedWonOpportunities', 'closedWonOpportunitiesCount', 'prospectingOpportunitiesSum', 'discoveryOpportunitiesSum', 'demoOrMeetingOpportunitiesSum', 'proposalOpportunitiesSum', 'negotiationOpportunitiesSum', 'awaitingDecisionOpportunitiesSum', 'postPurchaseOpportunitiesSum', 'closedWonOpportunitiesSum', 'regions'));
            } else {
                $setting = Utility::settings();
                $products = explode(',', $setting['product_type']);
                $regions = explode(',', $setting['region']);
                $assinged_staff = User::whereNotIn('id', [1, 3])->get();

                $currency_data = json_decode($setting['currency_conversion'], true);

                // Initialize variables to hold the conversion rates
                $usd = $eur = $gbp = null;

                // Iterate through the array and extract the conversion rates
                foreach ($currency_data as $currency) {
                    switch ($currency['code']) {
                        case 'USD':
                            $usd = $currency['conversion_rate_to_usd'];
                            break;
                        case 'EUR':
                            $eur = $currency['conversion_rate_to_usd'];
                            break;
                        case 'GBP':
                            $gbp = $currency['conversion_rate_to_usd'];
                            break;
                    }
                }

                // Prospecting Opportunities
                $prospectingOpportunities = Lead::where('assigned_user', \Auth::user()->id)
                    ->where('lead_status', 1)
                    ->whereIn('sales_stage', ['New', 'Contacted'])
                    ->get();


                $prospectingOpportunitiesSum = 0;

                foreach ($prospectingOpportunities as $opportunity) {
                    $valueOfOpportunity = str_replace(',', '', $opportunity->value_of_opportunity);
                    $valueOfOpportunity = (float)$valueOfOpportunity;

                    if ($opportunity->currency == 'GBP') {
                        $convertedValue = $valueOfOpportunity * $gbp;
                    } elseif ($opportunity->currency == 'EUR') {
                        $convertedValue = $valueOfOpportunity * $eur;
                    } else {
                        $convertedValue = $valueOfOpportunity;
                    }

                    $prospectingOpportunitiesSum += $convertedValue;
                }

                $prospectingOpportunitiesCount = $prospectingOpportunities->count();


                // Discovery Opportunities
                $discoveryOpportunities = Lead::where('assigned_user', \Auth::user()->id)
                    ->where('lead_status', 1)
                    ->whereIn('sales_stage', ['Qualifying', 'Qualified'])
                    ->get();

                $discoveryOpportunitiesSum = 0;

                foreach ($discoveryOpportunities as $opportunity) {
                    $valueOfOpportunity = str_replace(',', '', $opportunity->value_of_opportunity);
                    $valueOfOpportunity = (float)$valueOfOpportunity;

                    if ($opportunity->currency == 'GBP') {
                        $convertedValue = $valueOfOpportunity * $gbp;
                    } elseif ($opportunity->currency == 'EUR') {
                        $convertedValue = $valueOfOpportunity * $eur;
                    } else {
                        $convertedValue = $valueOfOpportunity;
                    }

                    $discoveryOpportunitiesSum += $convertedValue;
                }

                $discoveryOpportunitiesCount = $discoveryOpportunities->count();

                // Demo or Meeting Opportunities
                $demoOrMeetingOpportunities = Lead::where('assigned_user', \Auth::user()->id)
                    ->where('lead_status', 1)
                    ->whereIn('sales_stage', ['NDA Signed', 'Demo or Meeting'])
                    ->get();


                $demoOrMeetingOpportunitiesSum = 0;

                foreach ($demoOrMeetingOpportunities as $opportunity) {
                    $valueOfOpportunity = str_replace(',', '', $opportunity->value_of_opportunity);
                    $valueOfOpportunity = (float)$valueOfOpportunity;

                    if ($opportunity->currency == 'GBP') {
                        $convertedValue = $valueOfOpportunity * $gbp;
                    } elseif ($opportunity->currency == 'EUR') {
                        $convertedValue = $valueOfOpportunity * $eur;
                    } else {
                        $convertedValue = $valueOfOpportunity;
                    }

                    $demoOrMeetingOpportunitiesSum += $convertedValue;
                }

                $demoOrMeetingOpportunitiesCount = $demoOrMeetingOpportunities->count();

                // Proposal Opportunities
                $proposalOpportunities = Lead::where('assigned_user', \Auth::user()->id)
                    ->where('lead_status', 1)
                    ->where('sales_stage', 'Proposal')
                    ->get();


                $proposalOpportunitiesSum = 0;

                foreach ($proposalOpportunities as $opportunity) {
                    $valueOfOpportunity = str_replace(',', '', $opportunity->value_of_opportunity);
                    $valueOfOpportunity = (float)$valueOfOpportunity;

                    if ($opportunity->currency == 'GBP') {
                        $convertedValue = $valueOfOpportunity * $gbp;
                    } elseif ($opportunity->currency == 'EUR') {
                        $convertedValue = $valueOfOpportunity * $eur;
                    } else {
                        $convertedValue = $valueOfOpportunity;
                    }

                    $proposalOpportunitiesSum += $convertedValue;
                }

                $proposalOpportunitiesCount = $proposalOpportunities->count();

                // Negotiation Opportunities
                $negotiationOpportunities = Lead::where('assigned_user', \Auth::user()->id)
                    ->where('lead_status', 1)
                    ->where('sales_stage', 'Negotiation')
                    ->get();

                $negotiationOpportunitiesSum = 0;

                foreach ($negotiationOpportunities as $opportunity) {
                    $valueOfOpportunity = str_replace(',', '', $opportunity->value_of_opportunity);
                    $valueOfOpportunity = (float)$valueOfOpportunity;

                    if ($opportunity->currency == 'GBP') {
                        $convertedValue = $valueOfOpportunity * $gbp;
                    } elseif ($opportunity->currency == 'EUR') {
                        $convertedValue = $valueOfOpportunity * $eur;
                    } else {
                        $convertedValue = $valueOfOpportunity;
                    }

                    $negotiationOpportunitiesSum += $convertedValue;
                }

                $negotiationOpportunitiesCount = $negotiationOpportunities->count();

                // Awaiting Decision Opportunities
                $awaitingDecisionOpportunities = Lead::where('assigned_user', \Auth::user()->id)
                    ->where('lead_status', 1)
                    ->where('sales_stage', 'Awaiting Decision')
                    ->get();

                $awaitingDecisionOpportunitiesSum = 0;

                foreach ($awaitingDecisionOpportunities as $opportunity) {
                    $valueOfOpportunity = str_replace(',', '', $opportunity->value_of_opportunity);
                    $valueOfOpportunity = (float)$valueOfOpportunity;

                    if ($opportunity->currency == 'GBP') {
                        $convertedValue = $valueOfOpportunity * $gbp;
                    } elseif ($opportunity->currency == 'EUR') {
                        $convertedValue = $valueOfOpportunity * $eur;
                    } else {
                        $convertedValue = $valueOfOpportunity;
                    }

                    $awaitingDecisionOpportunitiesSum += $convertedValue;
                }

                $awaitingDecisionOpportunitiesCount = $awaitingDecisionOpportunities->count();

                // Post Purchase Opportunities
                $postPurchaseOpportunities = Lead::where('assigned_user', \Auth::user()->id)
                    ->where('lead_status', 1)
                    ->whereIn('sales_stage', ['Implementation', 'Follow-Up Needed'])
                    ->get();

                $postPurchaseOpportunitiesSum = 0;

                foreach ($postPurchaseOpportunities as $opportunity) {
                    $valueOfOpportunity = str_replace(',', '', $opportunity->value_of_opportunity);
                    $valueOfOpportunity = (float)$valueOfOpportunity;

                    if ($opportunity->currency == 'GBP') {
                        $convertedValue = $valueOfOpportunity * $gbp;
                    } elseif ($opportunity->currency == 'EUR') {
                        $convertedValue = $valueOfOpportunity * $eur;
                    } else {
                        $convertedValue = $valueOfOpportunity;
                    }

                    $postPurchaseOpportunitiesSum += $convertedValue;
                }

                $postPurchaseOpportunitiesCount = $postPurchaseOpportunities->count();

                // Closed Won Opportunities
                $closedWonOpportunities = Lead::where('assigned_user', \Auth::user()->id)
                    ->where('lead_status', 1)
                    ->where('sales_stage', 'Closed Won')
                    ->get();

                $closedWonOpportunitiesSum = 0;

                foreach ($closedWonOpportunities as $opportunity) {
                    $valueOfOpportunity = str_replace(',', '', $opportunity->value_of_opportunity);
                    $valueOfOpportunity = (float)$valueOfOpportunity;

                    if ($opportunity->currency == 'GBP') {
                        $convertedValue = $valueOfOpportunity * $gbp;
                    } elseif ($opportunity->currency == 'EUR') {
                        $convertedValue = $valueOfOpportunity * $eur;
                    } else {
                        $convertedValue = $valueOfOpportunity;
                    }

                    $closedWonOpportunitiesSum += $convertedValue;
                }

                $closedWonOpportunitiesCount = $closedWonOpportunities->count();
                return view('home', compact('assinged_staff', 'products', 'prospectingOpportunities', 'prospectingOpportunitiesCount', 'discoveryOpportunities', 'discoveryOpportunitiesCount', 'demoOrMeetingOpportunities', 'demoOrMeetingOpportunitiesCount', 'proposalOpportunities', 'proposalOpportunitiesCount', 'negotiationOpportunities', 'negotiationOpportunitiesCount', 'awaitingDecisionOpportunities', 'awaitingDecisionOpportunitiesCount', 'postPurchaseOpportunities', 'postPurchaseOpportunitiesCount', 'closedWonOpportunities', 'closedWonOpportunitiesCount', 'prospectingOpportunitiesSum', 'discoveryOpportunitiesSum', 'demoOrMeetingOpportunitiesSum', 'proposalOpportunitiesSum', 'negotiationOpportunitiesSum', 'awaitingDecisionOpportunitiesSum', 'postPurchaseOpportunitiesSum', 'closedWonOpportunitiesSum', 'regions'));
            }
        } else {

            if (!file_exists(storage_path() . "/installed")) {
                header('location:install');
                die;
            } else {
                $settings = Utility::settings();
                return redirect('login');
            }
        }
    }

    public function getOrderChart($arrParam)
    {
        $arrDuration = [];
        if ($arrParam['duration']) {
            if ($arrParam['duration'] == 'week') {
                $previous_week = strtotime("-2 week +1 day");
                for ($i = 0; $i < 14; $i++) {
                    $arrDuration[date('Y-m-d', $previous_week)] = date('d-M', $previous_week);
                    $previous_week = strtotime(date('Y-m-d', $previous_week) . " +1 day");
                }
            }
        }

        $arrTask          = [];
        $arrTask['label'] = [];
        $arrTask['data']  = [];
        foreach ($arrDuration as $date => $label) {

            $data               = Order::select(\DB::raw('count(*) as total'))->whereDate('created_at', '=', $date)->first();
            $arrTask['label'][] = $label;
            $arrTask['data'][]  = $data->total;
        }

        return $arrTask;
    }

    public  function calendarData($calenderdata = 'all')
    {
        $calls    = Call::where('created_by', \Auth::user()->creatorId())->get();
        $meetings = Meeting::where('created_by', \Auth::user()->creatorId())->get();
        $tasks    = Task::where('created_by', \Auth::user()->creatorId())->get();
        $blockeddate = Blockdate::where('created_by', \Auth::user()->creatorId())->get();

        $arrMeeting = [];
        $arrTask    = [];
        $arrCall    = [];
        $arrblock   = [];

        if ($calenderdata == 'call') {
            foreach ($calls as $call) {
                $arr['id']        = $call['id'];
                $arr['title']     = $call['name'];
                $arr['start']     = $call['start_date'];
                $arr['end']       = $call['end_date'];
                $arr['className'] = 'event-primary';
                $arr['url']       = route('call.show', $call['id']);
                $arrCall[]        = $arr;
            }
        } elseif ($calenderdata == 'task') {
            foreach ($tasks as $task) {
                $arr['id']        = $task['id'];
                $arr['title']     = $task['name'];
                $arr['start']     = $task['start_date'];
                $arr['end']       = $task['due_date'];
                $arr['className'] = 'event-success';
                $arr['url']       = route('task.show', $task['id']);
                $arrTask[]        = $arr;
            }
        } elseif ($calenderdata == 'meeting') {
            foreach ($meetings as $meeting) {
                $arr['id']        = $meeting['id'];
                $arr['title']     = $meeting['name'];
                $arr['start']     = $meeting['start_date'];
                $arr['end']       = $meeting['end_date'];
                $arr['className'] = 'event-info';
                $arr['url']       = route('meeting.show', $meeting['id']);
                $arrMeeting[]     = $arr;
            }
        } else {
            foreach ($calls as $call) {
                $arr['id']        = $call['id'];
                $arr['title']     = $call['name'];
                $arr['start']     = $call['start_date'];
                $arr['end']       = $call['end_date'];
                $arr['className'] = 'event-primary';
                $arr['url']       = route('call.show', $call['id']);
                $arrCall[]        = $arr;
            }
            foreach ($tasks as $task) {
                $arr['id']        = $task['id'];
                $arr['title']     = $task['name'];
                $arr['start']     = $task['start_date'];
                $arr['end']       = $task['due_date'];
                $arr['className'] = 'event-success';
                $arr['url']       = route('task.show', $task['id']);
                $arrTask[]        = $arr;
            }
            foreach ($meetings as $meeting) {
                $arr['id']        = $meeting['id'];
                $arr['title']     = $meeting['name'];
                $arr['start']     = $meeting['start_date'];
                $arr['end']       = $meeting['end_date'];
                $arr['className'] = 'event-info';
                $arr['url']       = route('meeting.show', $meeting['id']);
                $arrMeeting[]     = $arr;
            }
            foreach ($blockeddate as $blockeddate) {
                $arr['id']        = $blockeddate['id'];
                $arr['title']     = $blockeddate['purpose'];
                $arr['start']     = $blockeddate['start_date'];
                $arr['end']       = $blockeddate['end_date'];
                $arr['className'] = 'event-info';
                $arr['display']   = 'background';
                $arrblock[]     = $arr;
            }
        }

        $calandar = array_merge($arrCall, $arrMeeting, $arrTask, $arrblock);
        return  str_replace('"[', '[', str_replace(']"', ']', json_encode($calandar)));
    }
    public function get_data(Request $request)
    {
        $arrMeeting = [];
        $arrTask    = [];
        $arrCall    = [];

        if ($request->get('calender_type') == 'goggle_calender') {
            if ($type = 'task') {
                $arrTask =  Utility::getCalendarData($type);
            }

            if ($type = 'meeting') {
                $arrMeeting =  Utility::getCalendarData($type);
            }

            if ($type = 'call') {
                $arrCall =  Utility::getCalendarData($type);
            }

            $arrayJson = array_merge($arrCall, $arrMeeting, $arrTask);
        } else {

            $arrMeeting = [];
            $arrTask    = [];
            $arrCall    = [];

            $calls    = Call::get();
            $meetings = Meeting::get();
            $tasks    = Task::get();



            foreach ($tasks as $val) {

                $end_date = date_create($val->end_date);
                date_add($end_date, date_interval_create_from_date_string("1 days"));
                $arrTask[] = [
                    "id" => $val->id,
                    "title" => $val->name,
                    "start" => $val->start_date,
                    "end" => date_format($end_date, "Y-m-d H:i:s"),
                    "className" => $val->color,
                    "textColor" => '#FFF',
                    "url" => route('task.show', $val['id']),
                    "allDay" => true,
                ];
            }
            foreach ($meetings as $val) {

                $end_date = date_create($val->end_date);
                date_add($end_date, date_interval_create_from_date_string("1 days"));
                $arrMeeting[] = [
                    "id" => $val->id,
                    "title" => $val->name,
                    "start" => $val->start_date,
                    "end" => date_format($end_date, "Y-m-d H:i:s"),
                    "className" => $val->color,
                    "textColor" => '#FFF',
                    "url" => route('meeting.show', $val['id']),
                    "allDay" => true,
                ];
            }
            foreach ($calls as $val) {

                $end_date = date_create($val->end_date);
                date_add($end_date, date_interval_create_from_date_string("1 days"));
                $arrCall[] = [
                    "id" => $val->id,
                    "title" => $val->name,
                    "start" => $val->start_date,
                    "end" => date_format($end_date, "Y-m-d H:i:s"),
                    "className" => $val->color,
                    "textColor" => '#FFF',
                    "url" => route('call.show', $val['id']),
                    "allDay" => true,
                ];
            }
            $arrayJson = array_merge($arrCall, $arrMeeting, $arrTask);
        }
        return $arrayJson;
    }

    public function upcomingevents()
    {
        // echo "upcomingevents";
        // echo "<pre>";
        $date = today()->format('Y-m-d');
        // // $meeting = Meeting::all();
        $meetings = Meeting::where('start_date', '>=', $date)->get();
        // print_r($meeting);
        return view('meeting.index', compact('meetings'));
    }
    public function completedevents()
    {
        // echo "completedevents";
        // echo "<pre>";
        $date = today()->format('Y-m-d');
        // $meeting = Meeting::all();
        $meetings = Meeting::where('start_date', '<', $date)->get();
        return view('meeting.index', compact('meetings'));
    }
    public function pushnotify()
    {
        return view('pushnotification');
    }

    // Fiter dashboard data for Team member, Region and Products.
    // public function filterData(Request $request)
    // {
    //     $teamMember = $request->input('team_member');
    //     $region = $request->input('region');
    //     $products = $request->input('products');

    //     // Get currency conversion
    //     $setting = Utility::settings();
    //     $currency_data = json_decode($setting['currency_conversion'], true);
    //     $usd = $eur = $gbp = null;
    //     foreach ($currency_data as $currency) {
    //         switch ($currency['code']) {
    //             case 'USD':
    //                 $usd = $currency['conversion_rate_to_usd'];
    //                 break;
    //             case 'EUR':
    //                 $eur = $currency['conversion_rate_to_usd'];
    //                 break;
    //             case 'GBP':
    //                 $gbp = $currency['conversion_rate_to_usd'];
    //                 break;
    //         }
    //     }

    //     // Get all leads
    //     $leads = Lead::all();

    //     $opportunities = [];
    //     $prospectingOpportunitiesSum =
    //         $prospectingOpportunitiesCount =
    //         $discoveryOpportunitiesSum =
    //         $discoveryOpportunitiesCount =
    //         $demoOrMeetingOpportunitiesSum =
    //         $demoOrMeetingOpportunitiesCount =
    //         $proposalOpportunitiesSum =
    //         $proposalOpportunitiesCount =
    //         $negotiationOpportunitiesSum =
    //         $negotiationOpportunitiesCount =
    //         $awaitingDecisionOpportunitiesSum =
    //         $awaitingDecisionOpportunitiesCount =
    //         $postPurchaseOpportunitiesSum =
    //         $postPurchaseOpportunitiesCount =
    //         $closedWonOpportunitiesSum =
    //         $closedWonOpportunitiesCount = 0;

    //     foreach ($leads as $lead) {
    //         if ($lead->assigned_user == $teamMember) {
    //             // Fetch record for Prospecting Opportunity
    //             if ($lead->created_by == \Auth::user()->creatorId() && $lead->lead_status == 1 && in_array($lead->sales_stage, ['New', 'Contacted'])) {
    //                 $valueOfOpportunity = str_replace(',', '', $lead->value_of_opportunity);
    //                 $valueOfOpportunity = (float) $valueOfOpportunity;

    //                 if ($lead->currency == 'GBP') {
    //                     $convertedValue = $valueOfOpportunity * $gbp;
    //                 } elseif ($lead->currency == 'EUR') {
    //                     $convertedValue = $valueOfOpportunity * $eur;
    //                 } else {
    //                     $convertedValue = $valueOfOpportunity;
    //                 }

    //                 $prospectingOpportunitiesSum += $convertedValue;
    //                 $prospectingOpportunitiesCount++;

    //                 $opportunities['opportunities']['prospectingOpportunities'][] = $lead;
    //                 $opportunities['opportunities']['prospectingOpportunitiesSum'] = human_readable_number($prospectingOpportunitiesSum);
    //                 $opportunities['opportunities']['prospectingOpportunitiesCount'] = $prospectingOpportunitiesCount;
    //             }

    //             // Fetch record for Discovery Opportunity
    //             if ($lead->created_by == \Auth::user()->creatorId() && $lead->lead_status == 1 && in_array($lead->sales_stage, ['Qualifying', 'Qualified'])) {
    //                 $valueOfOpportunity = str_replace(',', '', $lead->value_of_opportunity);
    //                 $valueOfOpportunity = (float) $valueOfOpportunity;

    //                 if ($lead->currency == 'GBP') {
    //                     $convertedValue = $valueOfOpportunity * $gbp;
    //                 } elseif ($lead->currency == 'EUR') {
    //                     $convertedValue = $valueOfOpportunity * $eur;
    //                 } else {
    //                     $convertedValue = $valueOfOpportunity;
    //                 }

    //                 $discoveryOpportunitiesSum += $convertedValue;
    //                 $discoveryOpportunitiesCount++;

    //                 $opportunities['opportunities']['discoveryOpportunities'][] = $lead;
    //                 $opportunities['opportunities']['discoveryOpportunitiesSum'] = human_readable_number($discoveryOpportunitiesSum);
    //                 $opportunities['opportunities']['discoveryOpportunitiesCount'] = $discoveryOpportunitiesCount;
    //             }

    //             // Fetch record for DemoOrMeeting Opportunity
    //             if ($lead->created_by == \Auth::user()->creatorId() && $lead->lead_status == 1 && in_array($lead->sales_stage, ['NDA Signed', 'Demo or Meeting'])) {
    //                 $valueOfOpportunity = str_replace(',', '', $lead->value_of_opportunity);
    //                 $valueOfOpportunity = (float) $valueOfOpportunity;

    //                 if ($lead->currency == 'GBP') {
    //                     $convertedValue = $valueOfOpportunity * $gbp;
    //                 } elseif ($lead->currency == 'EUR') {
    //                     $convertedValue = $valueOfOpportunity * $eur;
    //                 } else {
    //                     $convertedValue = $valueOfOpportunity;
    //                 }

    //                 $demoOrMeetingOpportunitiesSum += $convertedValue;
    //                 $demoOrMeetingOpportunitiesCount++;

    //                 $opportunities['opportunities']['demoOrMeetingOpportunities'][] = $lead;
    //                 $opportunities['opportunities']['demoOrMeetingOpportunitiesSum'] = human_readable_number($demoOrMeetingOpportunitiesSum);
    //                 $opportunities['opportunities']['demoOrMeetingOpportunitiesCount'] = $demoOrMeetingOpportunitiesCount;
    //             }

    //             // Fetch record for Proposal Opportunity
    //             if ($lead->created_by == \Auth::user()->creatorId() && $lead->lead_status == 1 && $lead->sales_stage == 'Proposal') {
    //                 $valueOfOpportunity = str_replace(',', '', $lead->value_of_opportunity);
    //                 $valueOfOpportunity = (float) $valueOfOpportunity;

    //                 if ($lead->currency == 'GBP') {
    //                     $convertedValue = $valueOfOpportunity * $gbp;
    //                 } elseif ($lead->currency == 'EUR') {
    //                     $convertedValue = $valueOfOpportunity * $eur;
    //                 } else {
    //                     $convertedValue = $valueOfOpportunity;
    //                 }

    //                 $proposalOpportunitiesSum += $convertedValue;
    //                 $proposalOpportunitiesCount++;

    //                 $opportunities['opportunities']['proposalOpportunities'][] = $lead;
    //                 $opportunities['opportunities']['proposalOpportunitiesSum'] = human_readable_number($proposalOpportunitiesSum);
    //                 $opportunities['opportunities']['proposalOpportunitiesCount'] = $proposalOpportunitiesCount;
    //             }

    //             // Fetch record for Negotiation Opportunity
    //             if ($lead->created_by == \Auth::user()->creatorId() && $lead->lead_status == 1 && $lead->sales_stage == 'Negotiation') {
    //                 $valueOfOpportunity = str_replace(',', '', $lead->value_of_opportunity);
    //                 $valueOfOpportunity = (float) $valueOfOpportunity;

    //                 if ($lead->currency == 'GBP') {
    //                     $convertedValue = $valueOfOpportunity * $gbp;
    //                 } elseif ($lead->currency == 'EUR') {
    //                     $convertedValue = $valueOfOpportunity * $eur;
    //                 } else {
    //                     $convertedValue = $valueOfOpportunity;
    //                 }

    //                 $negotiationOpportunitiesSum += $convertedValue;
    //                 $negotiationOpportunitiesCount++;

    //                 $opportunities['opportunities']['negotiationOpportunities'][] = $lead;
    //                 $opportunities['opportunities']['negotiationOpportunitiesSum'] = human_readable_number($negotiationOpportunitiesSum);
    //                 $opportunities['opportunities']['negotiationOpportunitiesCount'] = $negotiationOpportunitiesCount;
    //             }

    //             // Fetch record for Awaiting Decision Opportunity
    //             if ($lead->created_by == \Auth::user()->creatorId() && $lead->lead_status == 1 && $lead->sales_stage == 'Awaiting Decision') {
    //                 $valueOfOpportunity = str_replace(',', '', $lead->value_of_opportunity);
    //                 $valueOfOpportunity = (float) $valueOfOpportunity;

    //                 if ($lead->currency == 'GBP') {
    //                     $convertedValue = $valueOfOpportunity * $gbp;
    //                 } elseif ($lead->currency == 'EUR') {
    //                     $convertedValue = $valueOfOpportunity * $eur;
    //                 } else {
    //                     $convertedValue = $valueOfOpportunity;
    //                 }

    //                 $awaitingDecisionOpportunitiesSum += $convertedValue;
    //                 $awaitingDecisionOpportunitiesCount++;

    //                 $opportunities['opportunities']['awaitingDecisionOpportunities'][] = $lead;
    //                 $opportunities['opportunities']['awaitingDecisionOpportunitiesSum'] = human_readable_number($awaitingDecisionOpportunitiesSum);
    //                 $opportunities['opportunities']['awaitingDecisionOpportunitiesCount'] = $awaitingDecisionOpportunitiesCount;
    //             }

    //             // Fetch record for Post Purchase Opportunity
    //             if ($lead->created_by == \Auth::user()->creatorId() && $lead->lead_status == 1 && in_array($lead->sales_stage, ['Implementation', 'Follow-Up Needed'])) {
    //                 $valueOfOpportunity = str_replace(',', '', $lead->value_of_opportunity);
    //                 $valueOfOpportunity = (float) $valueOfOpportunity;

    //                 if ($lead->currency == 'GBP') {
    //                     $convertedValue = $valueOfOpportunity * $gbp;
    //                 } elseif ($lead->currency == 'EUR') {
    //                     $convertedValue = $valueOfOpportunity * $eur;
    //                 } else {
    //                     $convertedValue = $valueOfOpportunity;
    //                 }

    //                 $postPurchaseOpportunitiesSum += $convertedValue;
    //                 $postPurchaseOpportunitiesCount++;

    //                 $opportunities['opportunities']['postPurchaseOpportunities'][] = $lead;
    //                 $opportunities['opportunities']['postPurchaseOpportunitiesSum'] = human_readable_number($postPurchaseOpportunitiesSum);
    //                 $opportunities['opportunities']['postPurchaseOpportunitiesCount'] = $postPurchaseOpportunitiesCount;
    //             }

    //             // Fetch record for Closed Won Opportunity
    //             if ($lead->created_by == \Auth::user()->creatorId() && $lead->lead_status == 1 && $lead->sales_stage == 'Closed Won') {
    //                 $valueOfOpportunity = str_replace(',', '', $lead->value_of_opportunity);
    //                 $valueOfOpportunity = (float) $valueOfOpportunity;

    //                 if ($lead->currency == 'GBP') {
    //                     $convertedValue = $valueOfOpportunity * $gbp;
    //                 } elseif ($lead->currency == 'EUR') {
    //                     $convertedValue = $valueOfOpportunity * $eur;
    //                 } else {
    //                     $convertedValue = $valueOfOpportunity;
    //                 }

    //                 $closedWonOpportunitiesSum += $convertedValue;
    //                 $closedWonOpportunitiesCount++;

    //                 $opportunities['opportunities']['closedWonOpportunities'][] = $lead;
    //                 $opportunities['opportunities']['closedWonOpportunitiesSum'] = human_readable_number($closedWonOpportunitiesSum);
    //                 $opportunities['opportunities']['closedWonOpportunitiesCount'] = $closedWonOpportunitiesCount;
    //             }
    //         }
    //     }

    //     return response()->json($opportunities);
    // }

    public function filterData(Request $request)
    {
        $teamMember = $request->input('team_member');
        $region = $request->input('region');
        $products = $request->input('products');

        // Get currency conversion
        $setting = Utility::settings();
        $currency_data = json_decode($setting['currency_conversion'], true);
        $usd = $eur = $gbp = null;
        foreach ($currency_data as $currency) {
            switch ($currency['code']) {
                case 'USD':
                    $usd = $currency['conversion_rate_to_usd'];
                    break;
                case 'EUR':
                    $eur = $currency['conversion_rate_to_usd'];
                    break;
                case 'GBP':
                    $gbp = $currency['conversion_rate_to_usd'];
                    break;
            }
        }

        $query = Lead::query();

        if (!empty($teamMember)) {
            $query->whereIn('assigned_user', $teamMember);
        }

        if (!empty($region)) {
            $query->whereIn('region', $region);
        }

        if (!empty($products)) {
            $query->where(function ($q) use ($products) {
                foreach ($products as $product) {
                    $q->orWhereJsonContains('products', $product);
                }
            });
        }

        $leads = $query->get();

        $salesStages = [
            'prospecting' => ['New', 'Contacted'],
            'discovery' => ['Qualifying', 'Qualified'],
            'demo_meeting' => ['NDA Signed', 'Demo or Meeting'],
            'proposal' => ['Proposal'],
            'negotiation' => ['Negotiation'],
            'awaiting_decision' => ['Awaiting Decision'],
            'post_purchase' => ['Implementation', 'Follow-Up Needed'],
            'closed_won' => ['Closed Won'],
        ];

        $opportunities = [];

        foreach ($salesStages as $stage => $statuses) {
            $filteredLeads = $leads->filter(function ($lead) use ($statuses) {
                return in_array($lead->sales_stage, $statuses);
            });

            $count = $filteredLeads->count();
            $sum = 0;
            $leadArray = [];

            foreach ($filteredLeads as $lead) {
                $valueOfOpportunity = str_replace(',', '', $lead->value_of_opportunity);
                $valueOfOpportunity = (float) $valueOfOpportunity;

                if ($lead->currency == 'GBP') {
                    $convertedValue = $valueOfOpportunity * $gbp;
                } elseif ($lead->currency == 'EUR') {
                    $convertedValue = $valueOfOpportunity * $eur;
                } else {
                    $convertedValue = $valueOfOpportunity;
                }

                $sum += $convertedValue;

                // Convert lead to array or model as needed
                $leadArray[] = $lead->toArray();
            }

            $opportunities[$stage] = [
                'lead' => $leadArray,
                'count' => $count,
                'sum' => $sum
            ];
        }

        return response()->json([
            'opportunities' => $opportunities
        ]);
    }
}

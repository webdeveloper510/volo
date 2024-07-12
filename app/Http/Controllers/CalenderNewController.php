<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meeting;
use App\Models\Blockdate;
use App\Models\User;
use Spatie\Permission\Models\Role;

class CalenderNewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blockeddate = Blockdate::all();
        return view('calender_new.index', compact('blockeddate'));
    }
    public function get_event_data(Request $request)
    {
        // echo "get_event_data";
        // die;
        $loggedInUserId = \Auth::user()->id;
        $userType = \Auth::user()->type;

        if ($userType == 'owner' || $userType == 'super admin') {
            $events = Meeting::where('start_date', $request->start)->get();
        } else {
            $events = Meeting::where('start_date', $request->start)
                ->whereJsonContains('user_id', (string) $loggedInUserId)
                ->get()
                ->filter(function ($event) use ($loggedInUserId) {
                    $status = $event->status;
                    return isset($status[(string) $loggedInUserId]) && $status[(string) $loggedInUserId] == "1";
                });
        }

        return response()->json(["events" => $events->values()]);
    }
    public function blockeddateinfo()
    {
        $block = Blockdate::all();
        return $block;
    }

    public function eventinfo()
    {
        // echo "eventinfo";
        // die;
        $loggedInUserId = \Auth::user()->id;
        @$user_roles = \Auth::user()->user_roles;
        @$userRole = Role::find($user_roles)->roleType;
        $userType = \Auth::user()->type;
        $userType = $userRole == 'company' ? 'owner' : $userType;
        if ($userType = 'owner') {
            $events = Meeting::all();
        } else {
            $events = Meeting::where(function ($query) use ($loggedInUserId) {
                $query->where('user_id', $loggedInUserId)
                    ->orWhereJsonContains('status', [(string) $loggedInUserId => "1"]);
            })
                ->get()
                ->filter(function ($event) use ($loggedInUserId) {
                    $status = $event->status;
                    return isset($status[(string) $loggedInUserId]) && $status[(string) $loggedInUserId] == "1";
                });
        }

        return $events;
    }
    public function monthbaseddata(Request $request)
    {
        $user = \Auth::user();
        $userId = \Auth::user()->id;
        $userRole = Role::find($user->user_roles);
        $userType = $user->type;
        $userRoleType = $userRole->roleType;
        $userRoleName = $userRole->name;

        $startDate = "{$request->year}-0{$request->month}-01";
        $endDate = date('Y-m-t', strtotime($startDate));

        if ($userType == 'owner' || $userType == 'admin' || $userType == 'snr manager') {
            $data = Meeting::whereBetween('start_date', [$startDate, $endDate])->get();
        } elseif ($userType == 'manager') {
            if ($userRoleType == 'individual') {
                $userTeamMemberIds = User::where('team_member', $user->id)->pluck('id');
                $data = Meeting::where(function ($query) use ($user, $userTeamMemberIds) {
                    $query->whereIn('user_id', $userTeamMemberIds)
                        ->orWhereJsonContains('status', [(string) $user->id => "1"]);
                })
                    ->whereBetween('start_date', [$startDate, $endDate])
                    ->get()
                    ->filter(function ($event) use ($user) {
                        $status = $event->status;
                        return isset($status[(string) $user->id]) && $status[(string) $user->id] == "1";
                    });
            } elseif ($userRoleType == 'company') {
                $data = Meeting::whereBetween('start_date', [$startDate, $endDate])->get();
            }
        } elseif ($userType == 'executive') {
            if ($userRoleType == 'individual') {
                $data = Meeting::whereBetween('start_date', [$startDate, $endDate])->get();
            } elseif ($userRoleType == 'company') {
                $data = Meeting::whereBetween('start_date', [$startDate, $endDate])->get();
            }
        } elseif ($userRoleName == 'restricted') {
            $data = Meeting::whereBetween('start_date', [$startDate, $endDate])->get();
        }
        return $data;
    }
    public function weekbaseddata(Request $request)
    {
        // echo "weekbaseddata";
        // die;
        $startDate = $request->startdate;
        $endDate = $request->enddate;

        if (\Auth::user()->type == 'owner' || \Auth::user()->type == 'super admin') {
            $data = Meeting::whereBetween('start_date', [$startDate, $endDate])->get();
        } else {
            $data = Meeting::where('user_id', \Auth::user()->id)
                ->whereBetween('start_date', [$startDate, $endDate])
                ->get();
        }

        return $data;
    }
    public function daybaseddata(Request $request)
    {
        // echo "daybaseddata";
        // die;
        $startDate = $request->date;

        if (\Auth::user()->type == 'owner' || \Auth::user()->type == 'super admin') {
            $data = Meeting::where('start_date', $startDate)->get();
        } else {
            $data = Meeting::where('user_id', \Auth::user()->id)
                ->where('start_date', $startDate)
                ->get();
        }

        return $data;
    }
}

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
        $user = \Auth::user();
        $userRole = Role::find($user->user_roles);
        $userType = $user->type;
        $userRoleType = $userRole->roleType;
        $loggedInUserId = (string) $user->id;

        $query = Meeting::where('start_date', $request->start);

        if ($userType == 'owner' || $userType == 'admin' || $userType == 'snr manager') {
            $events = $query->get();
        } elseif ($userType == 'manager' && $userRoleType == 'individual') {
            $events = $query->where('created_by', $user->id)->get();
        } elseif ($userType == 'manager' && $userRoleType == 'company') {
            $events = $query->where('created_by', $user->id)->get();
        } elseif ($userType == 'executive' && $userRoleType == 'individual') {
            $events = $query->whereJsonContains('user_id', $loggedInUserId)
                ->get()
                ->filter(function ($event) use ($loggedInUserId) {
                    $status = is_array($event->status) ? $event->status : json_decode($event->status, true);
                    return isset($status[$loggedInUserId]) && $status[$loggedInUserId] == "1";
                })
                ->values();
        } elseif ($userType == 'executive' && $userRoleType == 'company') {
            $events = $query->whereJsonContains('user_id', $loggedInUserId)->get();
        } else {
            $events = collect();
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
        $user = \Auth::user();
        $userRole = Role::find($user->user_roles);
        $userType = $user->type;
        $userRoleType = $userRole->roleType;

        if ($userType == 'owner' || $userType == 'admin' || $userType == 'snr manager') {
            $data = Meeting::all();
        } elseif ($userType == 'manager') {
            if ($userRoleType == 'individual') {
                $data = Meeting::where('created_by', \Auth::user()->id)->get();
            } elseif ($userRoleType == 'company') {
                $data = Meeting::where('created_by', \Auth::user()->id)->get();
            }
        } elseif ($userType == 'executive') {
            if ($userRoleType == 'individual') {
                $loggedInUserId = (string) $user->id;
                $data = Meeting::whereJsonContains('user_id', $loggedInUserId)
                    ->get()
                    ->filter(function ($event) use ($loggedInUserId) {
                        $status = is_array($event->status) ? $event->status : json_decode($event->status, true);
                        return isset($status[$loggedInUserId]) && $status[$loggedInUserId] == "1";
                    })
                    ->values();
                return $data;
            } elseif ($userRoleType == 'company') {
                $loggedInUserId = (string) $user->id;
                $data = Meeting::whereJsonContains('user_id', $loggedInUserId)->get();
            }
        }
        return $data;
    }
    public function monthbaseddata(Request $request)
    {
        $user = \Auth::user();
        $userRole = Role::find($user->user_roles);
        $userType = $user->type;
        $userRoleType = $userRole->roleType;

        $startDate = "{$request->year}-0{$request->month}-01";
        $endDate = date('Y-m-t', strtotime($startDate));

        if ($userType == 'owner' || $userType == 'admin' || $userType == 'snr manager') {
            $data = Meeting::whereBetween('start_date', [$startDate, $endDate])->get();
        } elseif ($userType == 'manager') {
            if ($userRoleType == 'individual') {
                $data = Meeting::where('created_by', \Auth::user()->id)
                    ->whereBetween('start_date', [$startDate, $endDate])->get();
            } elseif ($userRoleType == 'company') {
                $data = Meeting::where('created_by', \Auth::user()->id)
                    ->whereBetween('start_date', [$startDate, $endDate])->get();
            }
        } elseif ($userType == 'executive') {
            if ($userRoleType == 'individual') {
                $loggedInUserId = (string) $user->id;
                $data = Meeting::whereJsonContains('user_id', $loggedInUserId)
                    ->whereBetween('start_date', [$startDate, $endDate])
                    ->get()
                    ->filter(function ($event) use ($loggedInUserId) {
                        $status = is_array($event->status) ? $event->status : json_decode($event->status, true);
                        return isset($status[$loggedInUserId]) && $status[$loggedInUserId] == "1";
                    })
                    ->values();
                return $data;
            } elseif ($userRoleType == 'company') {
                $loggedInUserId = (string) $user->id;
                $data = Meeting::whereJsonContains('user_id', $loggedInUserId)
                    ->whereBetween('start_date', [$startDate, $endDate])->get();
            }
        }
        return $data;
    }
    public function weekbaseddata(Request $request)
    {
        $user = \Auth::user();
        $userRole = Role::find($user->user_roles);
        $userType = $user->type;
        $userRoleType = $userRole->roleType;

        $startDate = $request->startdate;
        $endDate = $request->enddate;

        if ($userType == 'owner' || $userType == 'admin' || $userType == 'snr manager') {
            $data = Meeting::whereBetween('start_date', [$startDate, $endDate])->get();
        } elseif ($userType == 'manager') {
            if ($userRoleType == 'individual') {
                $data = Meeting::where('created_by', \Auth::user()->id)
                    ->whereBetween('start_date', [$startDate, $endDate])->get();
            } elseif ($userRoleType == 'company') {
                $data = Meeting::where('created_by', \Auth::user()->id)
                    ->whereBetween('start_date', [$startDate, $endDate])->get();
            }
        } elseif ($userType == 'executive') {
            if ($userRoleType == 'individual') {
                $loggedInUserId = (string) $user->id;
                $data = Meeting::whereJsonContains('user_id', $loggedInUserId)
                    ->whereBetween('start_date', [$startDate, $endDate])
                    ->get()
                    ->filter(function ($event) use ($loggedInUserId) {
                        $status = is_array($event->status) ? $event->status : json_decode($event->status, true);
                        return isset($status[$loggedInUserId]) && $status[$loggedInUserId] == "1";
                    })
                    ->values();
                return $data;
            } elseif ($userRoleType == 'company') {
                $loggedInUserId = (string) $user->id;
                $data = Meeting::whereJsonContains('user_id', $loggedInUserId)
                    ->whereBetween('start_date', [$startDate, $endDate])->get();
            }
        }

        return $data;
    }

    public function daybaseddata(Request $request)
    {
        $user = \Auth::user();
        $userRole = Role::find($user->user_roles);
        $userType = $user->type;
        $userRoleType = $userRole->roleType;

        $startDate = $request->date;

        if ($userType == 'owner' || $userType == 'admin' || $userType == 'snr manager') {
            $data = Meeting::where('start_date', $startDate)->get();
        } elseif ($userType == 'manager') {
            if ($userRoleType == 'individual') {
                $data = Meeting::where('created_by', \Auth::user()->id)
                    ->where('start_date', $startDate)->get();
            } elseif ($userRoleType == 'company') {
                $data = Meeting::where('created_by', \Auth::user()->id)
                    ->where('start_date', $startDate)->get();
            }
        } elseif ($userType == 'executive') {
            if ($userRoleType == 'individual') {
                $loggedInUserId = (string) $user->id;
                $data = Meeting::whereJsonContains('user_id', $loggedInUserId)
                    ->where('start_date', $startDate)
                    ->get()
                    ->filter(function ($event) use ($loggedInUserId) {
                        $status = is_array($event->status) ? $event->status : json_decode($event->status, true);
                        return isset($status[$loggedInUserId]) && $status[$loggedInUserId] == "1";
                    })
                    ->values();
                return $data;
            } elseif ($userRoleType == 'company') {
                $loggedInUserId = (string) $user->id;
                $data = Meeting::whereJsonContains('user_id', $loggedInUserId)
                    ->where('start_date', $startDate)->get();
            }
        }

        return $data;
    }
}

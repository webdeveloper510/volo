<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meeting;
use App\Models\Blockdate;

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
        $loggedInUserId = \Auth::user()->id;
        if (\Auth::user()->type == 'owner' || \Auth::user()->type == 'super admin') {
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
        $loggedInUserId = \Auth::user()->id;
        $startDate = "{$request->year}-{$request->month}-01";
        $endDate = date('Y-m-t', strtotime($startDate));

        if (\Auth::user()->type == 'owner' || \Auth::user()->type == 'super admin') {
            $data = Meeting::whereBetween('start_date', [$startDate, $endDate])->get();
        } else {
            $data = Meeting::where(function ($query) use ($loggedInUserId) {
                $query->where('user_id', $loggedInUserId)
                    ->orWhereJsonContains('status', [(string) $loggedInUserId => "1"]);
            })
                ->whereBetween('start_date', [$startDate, $endDate])
                ->get()
                ->filter(function ($event) use ($loggedInUserId) {
                    $status = $event->status;
                    return isset($status[(string) $loggedInUserId]) && $status[(string) $loggedInUserId] == "1";
                });
        }
        return $data;
    }
    public function weekbaseddata(Request $request)
    {
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

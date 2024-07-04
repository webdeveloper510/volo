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
        if (\Auth::user()->type == 'owner' || \Auth::user()->type == 'super_admin') {
            $events = Meeting::where('start_date', $request->start)->get();
        } else {
            $events = Meeting::where('user_id', \Auth::user()->id)
                ->where('start_date', $request->start)
                ->get();
        }

        return response()->json(["events" => $events]);
    }
    public function blockeddateinfo()
    {
        $block = Blockdate::all();
        return $block;
    }

    public function eventinfo()
    {
        if (\Auth::user()->type == 'owner' || \Auth::user()->type == 'super_admin') {
            $events = Meeting::all();
        } else {
            $events = Meeting::where('user_id', \Auth::user()->id)->get();
        }

        return $events;
    }
    public function monthbaseddata(Request $request)
    {

        $startDate = "{$request->year}-{$request->month}-01"; // First day of the month
        $endDate = date('Y-m-t', strtotime($startDate)); // Last day of the month

        if (\Auth::user()->type == 'owner' || \Auth::user()->type == 'super_admin') {
            $data = Meeting::whereBetween('start_date', [$startDate, $endDate])->get();
        } else {
            $data = Meeting::where('user_id', \Auth::user()->id)
                ->whereBetween('start_date', [$startDate, $endDate])
                ->get();
        }

        return $data;
    }
    public function weekbaseddata(Request $request)
    {
        $startDate = $request->startdate;
        $endDate = $request->enddate;

        if (\Auth::user()->type == 'owner' || \Auth::user()->type == 'super_admin') {
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
        $data = Meeting::where('start_date', $startDate)->get();

        if (\Auth::user()->type == 'owner' || \Auth::user()->type == 'super_admin') {
            $data = Meeting::where('start_date', $startDate)->get();
        } else {
            $data = Meeting::where('user_id', \Auth::user()->id)
                ->where('start_date', [$startDate, $endDate])
                ->get();
        }

        return $data;
    }
}

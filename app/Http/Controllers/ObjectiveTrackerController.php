<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class ObjectiveTrackerController extends Controller
{
    public function index(){
        $users = User::where('created_by', \Auth::user()->creatorId())->get();     
        $logo = \App\Models\Utility::get_file('uploads/logo/');
        return view('objective_tracker.index', compact('logo', 'users'));
    }
}

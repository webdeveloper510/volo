<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ObjectiveTrackerController extends Controller
{
    public function index(){
        $logo = \App\Models\Utility::get_file('uploads/logo/');
        return view('objective_tracker.index', compact('logo'));
    }
}

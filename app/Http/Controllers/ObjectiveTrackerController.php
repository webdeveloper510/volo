<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ObjectiveTrackerController extends Controller
{
    public function index(){
        return view('objective_tracker.index');
    }
}

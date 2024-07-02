<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Objective;


class ObjectiveTrackerController extends Controller
{
    public function index()
    {
        $users = User::where('created_by', \Auth::user()->creatorId())->get();
        $logo = \App\Models\Utility::get_file('uploads/logo/');
        $objectives = Objective::all();
        return view('objective_tracker.index', compact('logo', 'users', 'objectives'));
    }

    public function create($type, $id)
    {
        $users = User::where('created_by', \Auth::user()->creatorId())->get();
        $assinged_staff = User::whereNotIn('id', [1, 3])->get();
        return view('objective_tracker.create', compact('users', 'id', 'type', 'assinged_staff'));
    }

    public function store(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());
        // die;

        if ($request->objectiveType == 'New') {
            $validator = \Validator::make(
                $request->all(),
                [
                    'employee' => 'required',
                    'year' => 'required',
                    'category' => 'required',
                    'objective' => 'required',
                    'measure' => 'required',
                    'key_dates' => 'required',
                    'status' => 'required',
                    // 'q1_updates' => 'required',
                    // 'q2_updates' => 'required',
                    // 'q3_updates' => 'required',
                    // 'q4_updates' => 'required',
                    // 'eoy_review' => 'required',
                    'update' => 'required',
                ]
            );

            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first())
                    ->withErrors($validator)
                    ->withInput();
            }

            $objective = new Objective();
            $objective->user_id = $request->employee;
            $objective->year = $request->year;
            $objective->category = $request->category;
            $objective->objective = $request->objective;
            $objective->measure = $request->measure;
            $objective->key_dates = $request->key_dates;
            $objective->status = $request->status;
            $objective->q1_updates = '';
            $objective->q2_updates = '';
            $objective->q3_updates = '';
            $objective->q4_updates = '';
            $objective->eoy_review = '';
            $objective->update = $request->update;
            $objective->update_type = $request->update_optgroup;
            $objective->save();

            if ($objective) {
                return redirect()->back()->with('success', 'Objective created successfully.');
            } else {
                return redirect()->back()->with('success', 'Something went wrong.');
            }
        }
    }
}

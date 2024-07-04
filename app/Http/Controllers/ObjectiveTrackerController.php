<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Objective;


class ObjectiveTrackerController extends Controller
{
    public function index()
    {
        $assinged_staff = User::whereNotIn('id', [1, 3])->get();
        $logo = \App\Models\Utility::get_file('uploads/logo/');

        // Get all objectives with user data
        $objectives = Objective::with('user')->get();

        // Calculate the task counts and percentages
        $completeTask = Objective::where('status', 'Complete')->count();
        $inProgressTask = Objective::where('status', 'In Progress')->count();
        $outstandingTask = Objective::where('status', 'Outstanding')->count();
        $totalTask = $completeTask + $inProgressTask + $outstandingTask;

        $completeTaskPercentage = $totalTask > 0 ? round(($completeTask / $totalTask) * 100, 2) : 0;
        $inProgressTaskPercentage = $totalTask > 0 ? round(($inProgressTask / $totalTask) * 100, 2) : 0;
        $outstandingTaskPercentage = $totalTask > 0 ? round(($outstandingTask / $totalTask) * 100, 2) : 0;
        $totalTaskPercentage = 100;

        // Get unique team member, category and status
        $uniqueTeamMembers = Objective::select('user_id')
            ->distinct()
            ->with('user')
            ->get();
        $uniqueCategory = Objective::select('category')->distinct()->pluck('category')->toArray();
        $uniqueStatus = Objective::select('status')->distinct()->pluck('status')->toArray();

        return view('objective_tracker.index', compact('logo', 'assinged_staff', 'objectives', 'completeTask', 'inProgressTask', 'outstandingTask', 'totalTask', 'completeTaskPercentage', 'inProgressTaskPercentage', 'outstandingTaskPercentage', 'totalTaskPercentage', 'uniqueTeamMembers', 'uniqueCategory', 'uniqueStatus'));
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
            $objective->q1_updates = $request->q1_updates;
            $objective->q2_updates = $request->q2_updates;
            $objective->q3_updates = $request->q3_updates;
            $objective->q4_updates = $request->q4_updates;
            $objective->eoy_review = $request->eoy_review;
            $objective->update = '';
            $objective->update_type = '';
            $objective->save();

            if ($objective) {
                return redirect()->back()->with('success', 'Objective created successfully.');
            } else {
                return redirect()->back()->with('success', 'Something went wrong.');
            }
        }
    }

    public function updateStatus(Request $request)
    {
        $objective = Objective::find($request->id);
        $objective->status = $request->status;
        $objective->save();

        // Calculate the task counts and percentages
        $totalTask = Objective::count();
        $outstandingTask = Objective::where('status', 'Outstanding')->count();
        $inProgressTask = Objective::where('status', 'In Progress')->count();
        $completeTask = Objective::where('status', 'Complete')->count();

        $outstandingTaskPercentage = $totalTask ? round(($outstandingTask / $totalTask) * 100, 2) : 0;
        $inProgressTaskPercentage = $totalTask ? round(($inProgressTask / $totalTask) * 100, 2) : 0;
        $completeTaskPercentage = $totalTask ? round(($completeTask / $totalTask) * 100, 2) : 0;
        $totalTaskPercentage = 100;

        return response()->json([
            'totalTask' => $totalTask,
            'outstandingTask' => $outstandingTask,
            'inProgressTask' => $inProgressTask,
            'completeTask' => $completeTask,
            'outstandingTaskPercentage' => $outstandingTaskPercentage,
            'inProgressTaskPercentage' => $inProgressTaskPercentage,
            'completeTaskPercentage' => $completeTaskPercentage,
            'totalTaskPercentage' => $totalTaskPercentage,
        ]);
    }

    public function filterObjective(Request $request)
    {
        $user_id = $request->input('user_id');
        $period = $request->input('period');

        // Get filtered data from objectives table
        $query = Objective::query()->with('user');

        if (!empty($user_id)) {
            $query->where('user_id', $user_id);
        }

        if (!empty($period)) {
            $query->where('year', $period);
        }

        $objectives = $query->get();

        // Calculate totals and percentages based on the filtered objectives
        $totalTask = $objectives->count();
        $outstandingTask = $objectives->where('status', 'Outstanding')->count();
        $inProgressTask = $objectives->where('status', 'In Progress')->count();
        $completeTask = $objectives->where('status', 'Complete')->count();

        $outstandingTaskPercentage = $totalTask ? round(($outstandingTask / $totalTask) * 100, 2) : 0;
        $inProgressTaskPercentage = $totalTask ? round(($inProgressTask / $totalTask) * 100, 2) : 0;
        $completeTaskPercentage = $totalTask ? round(($completeTask / $totalTask) * 100, 2) : 0;
        $totalTaskPercentage = 100;

        return response()->json([
            'objectives' => $objectives,
            'totalTask' => $totalTask,
            'outstandingTask' => $outstandingTask,
            'inProgressTask' => $inProgressTask,
            'completeTask' => $completeTask,
            'outstandingTaskPercentage' => $outstandingTaskPercentage,
            'inProgressTaskPercentage' => $inProgressTaskPercentage,
            'completeTaskPercentage' => $completeTaskPercentage,
            'totalTaskPercentage' => $totalTaskPercentage,
        ]);
    }

    public function updateStatusForFilterObjectives(Request $request)
    {
        $objectiveId = $request->input('objective_id');
        $status = $request->input('status');
        $userId = $request->input('user_id');
        $period = $request->input('period');

        $objective = Objective::find($objectiveId);

        if (!$objective) {
            return response()->json(['error' => 'Objective not found'], 404);
        }

        $objective->status = $status;
        $objective->save();

        // Get filtered data from objectives table
        $query = Objective::query()->with('user');

        if (!empty($userId)) {
            $query->where('user_id', $userId);
        }

        if (!empty($period)) {
            $query->where('year', $period);
        }

        $filteredObjectives = $query->get();

        // Calculate totals and percentages based on the filtered objectives
        $totalTask = $filteredObjectives->count();
        $outstandingTask = $filteredObjectives->where('status', 'Outstanding')->count();
        $inProgressTask = $filteredObjectives->where('status', 'In Progress')->count();
        $completeTask = $filteredObjectives->where('status', 'Complete')->count();

        $outstandingTaskPercentage = $totalTask ? round(($outstandingTask / $totalTask) * 100, 2) : 0;
        $inProgressTaskPercentage = $totalTask ? round(($inProgressTask / $totalTask) * 100, 2) : 0;
        $completeTaskPercentage = $totalTask ? round(($completeTask / $totalTask) * 100, 2) : 0;
        $totalTaskPercentage = 100;

        return response()->json([
            'totalTask' => $totalTask,
            'outstandingTask' => $outstandingTask,
            'inProgressTask' => $inProgressTask,
            'completeTask' => $completeTask,
            'outstandingTaskPercentage' => $outstandingTaskPercentage,
            'inProgressTaskPercentage' => $inProgressTaskPercentage,
            'completeTaskPercentage' => $completeTaskPercentage,
            'totalTaskPercentage' => $totalTaskPercentage,
        ]);
    }

    public function updateObjective(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'id' => 'required|exists:objectives,id',
            'category' => 'required|string|max:255',
            'objective' => 'required|string|max:255',
            'measure' => 'required|string|max:255',
            'keyDates' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'q1Updates' => 'nullable|string',
            'q2Updates' => 'nullable|string',
            'q3Updates' => 'nullable|string',
            'q4Updates' => 'nullable|string',
            'eoyReview' => 'nullable|string',
        ]);

        // Retrieve the objective by id
        $objective = Objective::find($validatedData['id']);

        // Check if the objective exists
        if (!$objective) {
            return response()->json(['message' => 'Objective not found', 'http_response_code' => 404], 404);
        }

        // Update the objective fields
        $objective->category = $validatedData['category'];
        $objective->objective = $validatedData['objective'];
        $objective->measure = $validatedData['measure'];
        $objective->key_dates = $validatedData['keyDates'];
        $objective->status = $validatedData['status'];
        $objective->q1_updates = $validatedData['q1Updates'];
        $objective->q2_updates = $validatedData['q2Updates'];
        $objective->q3_updates = $validatedData['q3Updates'];
        $objective->q4_updates = $validatedData['q4Updates'];
        $objective->eoy_review = $validatedData['eoyReview'];
        $objective->save();

        // Return a success response
        return response()->json(['message' => 'Objective updated successfully', 'objective' => $objective, 'http_response_code' => 200], 200);
    }
}

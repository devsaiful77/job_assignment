<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Enums\Status;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Jobs\ProcessCsvJob;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index()
    {
        try {
            $user = Auth::user();
            $tasks = $user->role_id == Status::ADMIN
                ? Task::with(['project:id,name', 'assignedUser:id,name'])->get()
                : Task::with('project:id,name')->where('assigned_to', $user->id)->get();

            return response()->json([
                'status' => true,
                'tasks' => $tasks
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'project_id' => ['required'],
            'assigned_to' => ['required'],
        ]);

        try {

            Task::create($data);
            return response()->json([
                'status' => true,
                'message' => 'Task created successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        try {
            return response()->json([
                'status' => true,
                'task' => $task,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }


    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $data = $request->validate([
            'project_id' => ['required'],
            'assigned_to' => ['required'],
        ]);


        try {
            $task->update($data);
            return response()->json([
                'status' => true,
                'message' => 'Task update successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function taskUpdate(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $data = $request->validate([
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:500'],
            'status' => ['required'],
        ]);


        try {
            $task->update($data);
            return response()->json([
                'status' => true,
                'message' => 'Task update successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }


    public function getProjectAndUser()
    {
        try {
            $users = User::where('role_id', Status::USER)->select('id', 'name')->get();
            $projects = Project::select('id', 'name')->get();

            return response()->json([
                'status' => true,
                'users' => $users,
                'projects' => $projects,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }



    // csv file upload 
    public function uploadTasks(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|mimes:csv,txt|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        $file = $request->file('csv_file');
        $path = $file->store('csv_files');

        // Dispatch the job to process CSV in the background
        ProcessCsvJob::dispatch($path, auth()->user()->id);

        return response()->json(['status' => true, 'message' => 'CSV uploaded and processing started.']);
    }
}

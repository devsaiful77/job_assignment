<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Enums\Status;
use App\Models\Project;
use App\Jobs\ProcessCsvJob;
use App\Models\TaskHistory;

use Illuminate\Http\Request;
use App\Events\TaskAssignedEvent;
use App\Events\TaskUpdatedEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

            $task = Task::create($data);

            TaskHistory::create([
                'task_id' => $task->id,
                'user_id' => auth()->id(),
                'status' => 'assigned',
            ]);

            event(new TaskAssignedEvent($task));
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

            $exiting_task = TaskHistory::where('task_id',$task->id)->first();
            if($exiting_task){
                $exiting_task->delete();
            }

            TaskHistory::create([
                'task_id' => $task->id,
                'user_id' => auth()->id(),
                'status' => 'assigned',
            ]);

            event(new TaskAssignedEvent($task));


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

            // task history updated...
            $task_history = TaskHistory::where('task_id',$task->id)->first();
            $task_history->status = $task->status == 'pending' ? 'assigned' : 'completed'; 
            $task_history->save(); 

            event(new TaskUpdatedEvent($task));



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

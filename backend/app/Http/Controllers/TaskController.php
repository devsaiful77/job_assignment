<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $this->authorize('viewAny', Task::class);

        $user = Auth::user();
        $tasks = $user->role_id == Status::ADMIN || $user->role_id == Status::MANAGER
            ? Task::with(['project', 'assignedUser'])->get()
            : Task::where('assigned_to', $user->id)->get();
    }
}

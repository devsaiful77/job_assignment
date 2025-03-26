<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        try {
            $project = Project::orderBy('id', 'desc')->get();
            return response()->json([
                'status' => true,
                'project' => $project
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
        try {
            $data = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string', 'max:600'],
            ]);

            $data['created_by'] = Auth::user()->id;

            Project::create($data);
            return response()->json([
                'status' => true,
                'message' => 'Project created successfully',
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
        try {
            $data = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string', 'max:600'],
            ]);

            $data['created_by'] = Auth::user()->id;

            Project::find($id)->update($data);
            return response()->json([
                'status' => true,
                'message' => 'Project updated successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
}

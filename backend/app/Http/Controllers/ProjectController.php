<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Project::class);

        try {
            $projects = Project::with('createBy:id,name')->orderBy('id', 'desc')->get();
            return response()->json([
                'status' => true,
                'projects' => $projects
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
        $this->authorize('create', Project::class);
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:projects'],
            'description' => ['required', 'string', 'max:600'],
        ]);

        try {

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

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $this->authorize('update', $project);
        try {
            return response()->json([
                'status' => true,
                'project' => $project,
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
        $project = Project::findOrFail($id);
        $this->authorize('update', $project);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:projects,name,' . $id],
            'description' => ['required', 'string', 'max:600'],
        ]);

        try {

            $data['created_by'] = Auth::user()->id;

            $project->update($data);
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

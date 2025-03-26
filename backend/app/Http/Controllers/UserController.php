<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{   


    public function index()
    {
        try {
            $users = User::where('id', '!=', Auth::user()->id)->orderBy('id', 'DESC')->get();
            return response()->json([
                'status' => true,
                'users' => $users
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
            $validatedData = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'role_id' => ['required'],
            ]);

            User::create($validatedData);
            return response()->json([
                'status' => true,
                'message' => 'User created successfully',
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
        try {
            $user = User::findOrFail($id);
            return response()->json([
                'status' => true,
                'user' => $user,
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
            $validatedData = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
                'role_id' => ['required'],
            ]);

            User::findOrFail($id)->update($validatedData);
            return response()->json([
                'status' => true,
                'message' => 'User updated successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function passwordUpdate(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            User::find($id)->update(['password' => bcrypt($validatedData['password'])]);
            return response()->json([
                'status' => true,
                'message' => 'Password updated successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function activeInactive($id)
    {
        try {
            $user = User::find($id);
            $user->status = $user->status == 1 ? 0 : 1;
            $user->save();
            return response()->json([
                'status' => true,
                'message' => 'User status updated successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
}

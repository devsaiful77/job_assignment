<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email|string|exists:users,email',
            'password' => [
                'required',
            ],
        ]);

        try {
            if (!Auth::attempt($credentials)) {
                return response([
                    'error' => 'The Provided credentials are not correct'
                ], 422);
            }
            $user = Auth::user();
            $token = $user->createToken('main')->plainTextToken;

            return response()->json([
                'status' => true,
                'user' => $user,
                'token' => $token
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function logout()
    {
        try {
            /** @var User $user */
            $user = Auth::user();
            $user->currentAccessToken()->delete();

            return response()->json([
                'status' => true,
                'message' => 'User logged out successfully'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}

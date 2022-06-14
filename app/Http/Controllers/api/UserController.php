<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        // search for user with email
        $user = User::where('email', $request->email)->first();

        // if user not found
        if (!$user) {
            return response()->json([
                'message' => 'User not found, please verify your credentials',
            ], 404);
        }

        // if user found and password is incorrect
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Password is incorrect',
            ], 401);
        }

        // if user found and password is correct
        // first delete all tokens for this user
        $user->tokens()->delete();
        // then create new token
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message' => 'User logged in successfully',
            'token' => $token,
        ], 200);
    }

    public function userProfile()
    {
        return response()->json([
            'message' => 'User profile',
            'user' => auth()->user(),
        ], 200);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'message' => 'User logged out successfully',
        ], 200);
    }
}

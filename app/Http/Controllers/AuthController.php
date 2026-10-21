<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use App\Models\User;

class AuthController
{
    public function store(Request $request)
    {
        $switch = $request->input('switch');

        if($switch == 'admin') {

            $request->validate([
                'email' => 'required|string',
                'password' => 'required',
            ]);

            // check for username+password
            $user = User::where('email', $request->email)->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'message' => 'Invalid email or password'
                ], 401);
            }

            // create a token
            $token = $user->createToken('admin-login')->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
                'user' => $user,
            ]);
        }
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
    }
}

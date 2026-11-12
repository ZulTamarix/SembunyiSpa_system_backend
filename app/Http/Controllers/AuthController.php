<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\User_token;

class AuthController
{

    public function store(Request $request)
    {
        $switch = $request->input('switch');
        try {
            $switch = $request->input('switch');

            return DB::transaction(function () use ($request, $switch) {

                // 0. Validate
                $validator = Validator::make($request->all(), [
                    'email' => 'required|string',
                    'password' => 'required|string',
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'status' => false,
                        'message' => $validator->errors()
                    ], 422);
                }

                // 1. Login
                $user = User::where('email', $request->email)
                            ->when(
                                $switch == 'admin',
                                fn ($query) => $query->where('role', 'admin'),
                                fn ($query) => $query->where('role', '!=', 'admin')
                            )
                            ->first();

                if (!$user || !Hash::check($request->password, $user->password)) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Invalid email or password'
                    ], 401);
                }

                $token = $user->createToken('admin-login')->plainTextToken;

                // 2. Create user's token based on their device\
                $user_token = [];
                if (!$switch) {

                    $user_token = User_token::updateOrCreate(
                        [
                            'user_id' => $user->id,
                        ],
                        [
                            'token' => $request->token,
                        ]
                    );

                }

                return response()->json([
                    'status' => true,
                    'message' => 'Login successful',
                    'token' => $token,
                    'user' => $user,
                    'token_device' => $user_token
                ]);
            });

        } 
        catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
            
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['status' => true]);
    }
}

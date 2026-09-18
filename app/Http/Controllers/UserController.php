<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User\User;
use App\Models\User\User_therapist;
use App\Models\User\User_customer;

class UserController
{
    // 1) GET — fetch all
    public function index()
    {
        return response()->json(User::all());
    }

    // 2) POST
    public function store(Request $request)
    {
        $validated = $request->validate([
            'role'  => 'required|string',
            'name'  => 'required|string',
            'email'  => 'required|string',
            'phoneNo'  => 'required|string',
            'password'  => 'required|string',
            'position'  => 'nullable|string',
            'code'      => 'nullable|string',
            'date_joined'   => 'nullable|string',
        ]);

        // Check if data already exists, if not create it
        $user = User::firstOrCreate(
            [ 'email' => $validated['email']],
            [
                'role' => $validated['role'],
                'name' => $validated['name'],
                'phoneNo' => $validated['phoneNo'],
                'password' => Hash::make($validated['password']),
                'status' => 'active'
            ]
        );

        // 1) If role == 'therapist', create 'therapist' table
        if ($validated['role'] === 'therapist') {
            User_therapist::create([
                'user_id'  => $user->id,
                'position' => $validated['position'],
                'code'     => $validated['code'],
            ]);
        }
        // 2) If role == 'customer', create 'customer' table
        elseif ($validated['role'] === 'customer') {
            User_customer::create([
                'user_id'  => $user->id,
                'total_booking'   => 0,
                'date_joined'     => $validated['date_joined'],
            ]);
        }

    }
}

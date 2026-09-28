<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use App\Models\User;

class UserController
{
    // 1) GET — fetch all
    public function index(Request $request)
    {
        $role = $request->input('role');
        $extra = $request->input('extra');

        // if role is specified
        if ($role) {
            if($extra == 'membership') {
                
                return response()->json(
                    User::where('role', $role)->whereNotNull('membership_id')->with('membership', 'membership.privilege')->get()->map(function ($user) {
                        return [
                            'user' => $user->except('membership', 'membership.privilege'),
                            'membership' => $user-> membership?->except('privilege'),
                            'membership_privilege' => $user->membership?->privilege,
                        ];
                    })
                );
            }
            else if($extra == 'no_membership') {
                
                return response()->json(
                    User::where('role', $role)->whereNull('membership_id')->get()
                );
            }
            else if($extra == 'include walk in') {
                
                return response()->json(
                    User::whereIn('role', ['customer', 'walkin'])->get()
                );
            }
            else {
                return response()->json(
                    User::where('role', $role)->get()
                );
            }
        }
        else {
            return response()->json(User::all());
        }
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
            'specialty'  => 'nullable|string',
            'code'      => 'nullable|string',
            'date_joined'   => 'nullable|string',
        ]);

        User::Create(
            [ 
                'email' => $validated['email'],
                'phoneNo' => $validated['phoneNo'],
                'role' => $validated['role'],
                'name' => $validated['name'],
                'password' => Hash::make($validated['password']),
                'status' => 'active',
                'date_joined'   => $validated['date_joined'],

                ...($validated['role'] == 'therapist' ? [
                    'code'  => $validated['code'],
                    'specialty' => $validated['specialty']
                ] : [])
            ]
        );
    }

    // 3) PUT
    public function update(Request $request, $id)
    {
        // check if it exist
        $user = User::findOrFail($id);
        $switch = $request->input('switch');

        if($switch == 'membership'){
            $validated = $request->validate([
                'membership_id' => 'required|integer',
                'code' => 'required|string',
            ]);

            $user->update($validated);
        }
    }
}

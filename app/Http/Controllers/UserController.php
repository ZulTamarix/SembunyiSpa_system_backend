<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Voucher\Voucher;
use App\Models\Voucher\Voucher_customer;

class UserController
{
    // 1) GET — fetch all
    public function index(Request $request)
    {
        $role = $request->input('role');
        $extra_1 = $request->input('extra_1');
        $extra_2 = $request->input('extra_2');

        // if role is specified
        if ($role) {
            // a)
            if($extra_1 == 'membership') {
                return response()->json(
                    User::where('role', $role)->whereNotNull('membership_id')->with('membership', 'membership.voucher')->get()->map(function ($user) {
                        return [
                            'user' => $user->except('membership', 'membership.voucher'),
                            'membership' => $user-> membership,
                        ];
                    })
                );
            }
            // b)
            else if($extra_1 == 'no_membership') {
                return response()->json(
                    User::where('role', $role)->whereNull('membership_id')->get()
                );
            }
            // c)
            else if($extra_1 == 'include walk in') {
                // c) i)
                if($extra_2 == 'include voucher') {
                    return response()->json(
                        User::whereIn('role', ['customer', 'walkin'])->with('voucherCustomers')->get()
                    );
                } 
                // c) ii)
                else {
                    return response()->json(
                        User::whereIn('role', ['customer', 'walkin'])->get()
                    );
                }

            }
            // d)
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

        // 1)
        if($switch == 'membership'){

             // Validate request
            $validated = $request->validate([
                'membership_id' => 'required|integer',
                'membership_date_expired' => 'nullable|string',
                'code' => 'required|string',
            ]);

            // if 1 fail, all fail
            DB::transaction(function () use ($validated, $user) {

                // 1. Update user
                $user->update([
                    'membership_id' => $validated['membership_id'],
                    'membership_date_expired' => $validated['membership_date_expired'],
                    'code' => $validated['code'],
                ]);

                // 2. Get all active vouchers for this membership
                $vouchers = Voucher::where('membership_id', $validated['membership_id'])
                    ->where('status', 'active')
                    ->get();

                // 3. Create voucher_customer for each voucher
                foreach ($vouchers as $voucher) {

                    Voucher_customer::create([
                        'voucher_id' => $voucher->id,
                        'user_id' => $user->id,
                        'quantity' => $voucher->quantity,
                        'date_expired' => $voucher->date_expired,
                    ]);
                }
            });
        }

        // 2)
        else if($switch == 'user'){

             // Validate request
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

            // 1. Update user
            $user->update([
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
            ]);
        }
    }
}

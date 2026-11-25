<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Membership;
use App\Models\Voucher\Voucher;
use App\Models\Voucher\Voucher_customer;

class UserController
{
    // 1) GET — fetch all
    public function index(Request $request)
    {
        $role = $request->input('role');
        $extra = $request->input('extra');

        // if role is specified
        if ($role) {
            // a)
            if($extra == 'include_admin') {
                return response()->json(
                    User::whereIn('role', ['therapist', 'admin'])->get()
                );
            }
            // b)
            if($extra == 'include_voucher') {
                return response()->json(
                    User::where('role', 'customer')
                    ->with([
                        'voucherCustomers',
                        'voucherCustomers.voucher'
                    ])
                    ->get()
                    ->map(function ($booking) {
                        return [
                            'user' => $booking->except('voucherCustomers'),
                            'voucherCustomers' => $booking->voucherCustomers
                                ->filter(function ($voucherCustomer) {
                                    return $voucherCustomer->voucher
                                        && $voucherCustomer->quantity !== 0
                                        && $voucherCustomer->voucher->discount_type != 'complimentary';
                                })
                                ->values(),
                        ];
                    })
                );
            }
            // c)
            else if($extra == 'full_customer') {
                return response()->json(
                    User::where('role', $role)->with('voucherCustomers', 'voucherCustomers.voucher', 'voucherCustomers.log', 'membership', 'booking')->get()
                );

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
            'password'  => 'sometimes|nullable|string',
            'specialty'  => 'sometimes|nullable|string',
            'code'      => 'sometimes|nullable|string',
            'date_birthday' => 'sometimes|nullable|string',
        ]);

        $user = User::Create([
            'email' => $validated['email'],
            'phoneNo' => $validated['phoneNo'],
            'role' => $validated['role'],
            'name' => $validated['name'],
            'password' => isset($validated['password'])
                ? Hash::make($validated['password'])
                : null,
            'status' => 'active',
            'date_birthday' => $validated['date_birthday'] ?? null,

            ...($validated['role'] == 'therapist' ? [
                'code' => $validated['code'] ?? null,
                'specialty' => $validated['specialty'] ?? null
            ] : [])
        ]);

        // optional to catch
        return response()->json([
            'id' => $user->id
        ], 201);
    }

    // 3) PUT
    public function update(Request $request, $id)
    {

        // check if it exist
        $user = User::findOrFail($id);
        $switch = $request->input('switch');
        $code_old = $request->input('code');

        // 1)
        if ($switch == 'membership') {
            $validated = $request->validate([
                'membership_id' => 'required|integer',
                'membership_date_expired' => 'nullable|string',
            ]);

            // Get membership
            $membership = Membership::findOrFail($validated['membership_id']);

            // a) if code != null
            if ($code_old) {
                $code = $membership->serial_code . ($code_old);
            }
            // b) if code == null
            else {
                // Count user based on total membership
                $total = User::whereNotNull('membership_id')->count();

                // Count users that have code and role customer or walkin
                $total = User::whereIn('role', ['customer', 'walkin'])
                    ->whereNotNull('code')
                    ->count();

                // Generate code
                $code = $membership->serial_code . ($total + 1);
            }

            DB::transaction(function () use ($validated, $user, $code) {

                // 1. Update user
                $user->update([
                    'membership_id' => $validated['membership_id'],
                    'membership_date_expired' => $validated['membership_date_expired'],
                    'code' => $code,
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
                        'date_expired' => $validated['membership_date_expired'],
                        'serial_no' => strtoupper(Str::random(8)),
                        'status' => $voucher->status,
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
                'date_birthday' => 'nullable|string',
            ]);

            // 1. Update user
            $user->update([
                'email' => $validated['email'],
                'phoneNo' => $validated['phoneNo'],
                'role' => $validated['role'],
                'name' => $validated['name'],
                'password' => Hash::make($validated['password']),
                'status' => 'active',
                'date_birthday' => $validated['date_birthday'],

                ...($validated['role'] == 'therapist' ? [
                    'code'  => $validated['code'],
                    'specialty' => $validated['specialty']
                ] : [])
            ]);
        }
    }

    // 4) DELETE
    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json([
                'status' => true,
                'message' => 'User deleted successfully.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}

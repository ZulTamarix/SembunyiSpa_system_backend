<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Membership\Membership;
use App\Models\Membership\Membership_customer;
use App\Models\Membership\Membership_privilege;

class MembershipController
{
    // 1) GET — fetch all
    public function index(Request $request)
    {
        $type = $request->input('type');

        // 1) membership
        if ($type == 'membership') {
            return response()->json(
                Membership::with('privilege')->get()->map(function ($membership) {
                    return [
                        'membership' => $membership->except('privilege'),
                        'membership_privilege' => $membership->privilege
                    ];
                })
            );
        }
        // 2) customer
        elseif ($type == 'customer') {
            return response()->json(
                Membership_customer::with('membership', 'user_customer', 'user_customer.user')->get()->map(function ($customer) {
                    return [
                        'membership_customer' => $customer->except('membership', 'user_customer', 'user_customer.user'),
                        'membership' => $customer->membership,
                        // 'user_customer' => $customer->user_customer,
                        'user' => $customer->user_customer->user
                    ];
                })
            );
        }
    }

    // 2) POST
    public function store(Request $request)
    {
        $type = $request->input('type');

        // 1) membership
        if ($type == 'membership') {
            // validation
            $validated = $request->validate([
                'tier' => 'required|string',
                
                'privilege_list' => 'required|array',
                'privilege_list.*' => 'required|string',
            ]);

            // if 1 fail, all fail
            DB::transaction(function () use ($validated) {
                // a) Create data for 'membership' 
                $membership = Membership::create(
                    [
                        'tier' => $validated['tier'],
                    ]
                );
                // b) Create data for 'package_privilege'
                foreach ($validated['privilege_list'] as $list) {
                    Membership_privilege::create([
                        'membership_id' => $membership->id,
                        'list' => $list,
                    ]);
                }
            });
        }
        // 2) customer
        elseif ($type == 'customer') {
            // validation
            $validated = $request->validate([
                'user_customer_id' => 'required|integer',
                'membership_id' => 'required|integer',
                'code' => 'required|string',
                'date_joined' => 'required|string',
            ]);

            // a) Create data for 'membership' 
            Membership_customer::create(
                [
                    'user_customer_id' => $validated['user_customer_id'],
                    'membership_id' => $validated['membership_id'],
                    'code' => $validated['code'],
                    'date_joined' => $validated['date_joined'],
                ]
            );
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Membership\Membership;
use App\Models\Membership\Membership_privilege;
use App\Models\Voucher\Voucher;

class MembershipController
{
    // 1) GET — fetch all
    public function index()
    {
        return response()->json(
            Membership::with('privilege')->get()->map(function ($membership) {
                return [
                    'membership' => $membership->except('privilege'),
                    'membership_privilege' => $membership->privilege
                ];
            })
        );
    }

    // 2) POST
    public function store(Request $request)
    {
        // validation
        $validated = $request->validate([
            // a) membership
            'tier' => 'required|string',
            
            // b) membership_privilege
            'privilege_list' => 'required|array',
            'privilege_list.*' => 'required|string',
            
            // c) voucher
            'voucher_list' => 'required|array',
            'voucher_list.*.code' => 'required|string',
            'voucher_list.*.description' => 'required|string',
            'voucher_list.*.type' => 'required|string',
            'voucher_list.*.date_expired' => 'nullable|date',
            'voucher_list.*.status' => 'required|string',
            'voucher_list.*.discount_type' => 'required|string',
            'voucher_list.*.discount_value' => 'nullable|integer',
            'voucher_list.*.quantity' => 'nullable|integer',
        ]);

        // if 1 fail, all fail
        DB::transaction(function () use ($validated) {
            // a) Create data for 'membership' 
            $membership = Membership::create(
                [
                    'tier' => $validated['tier'],
                ]
            );
            // 2. Create voucher + membership privilege
            foreach ($validated['privilege_list'] as $index => $list) {

                // Create voucher
                $voucher = Voucher::create([
                    'code' => $validated['voucher_list'][$index]['code'],
                    'description' => $validated['voucher_list'][$index]['description'],
                    'type' => $validated['voucher_list'][$index]['type'],
                    'date_expired' => $validated['voucher_list'][$index]['date_expired'],
                    'status' => $validated['voucher_list'][$index]['status'],
                    'discount_type' => $validated['voucher_list'][$index]['discount_type'],
                    'discount_value' => $validated['voucher_list'][$index]['discount_value'],
                    'quantity' => $validated['voucher_list'][$index]['quantity'],
                ]);

                // Assign voucher ID to membership_privilege
                Membership_privilege::create([
                    'membership_id' => $membership->id,
                    'voucher_id' => $voucher->id,
                    'list' => $list,
                ]);
            }
        });


        
    }
}

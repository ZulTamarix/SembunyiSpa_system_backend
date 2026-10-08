<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Membership;
use App\Models\Voucher\Voucher;

class MembershipController
{
    // 1) GET — fetch all
    public function index()
    {
        return response()->json(
            Membership::with('voucher')->get()->map(function ($membership) {
                return [
                    'membership' => $membership->except('voucher'),
                    'voucher' => $membership->voucher
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
            
            // b) voucher
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
            foreach ($validated['voucher_list'] as $index => $list) {

                // Create voucher
                Voucher::create([
                    'membership_id' => $membership->id,
                    'code' => $validated['voucher_list'][$index]['code'],
                    'description' => $validated['voucher_list'][$index]['description'],
                    'type' => $validated['voucher_list'][$index]['type'],
                    'date_expired' => $validated['voucher_list'][$index]['date_expired'],
                    'status' => $validated['voucher_list'][$index]['status'],
                    'discount_type' => $validated['voucher_list'][$index]['discount_type'],
                    'discount_value' => $validated['voucher_list'][$index]['discount_value'],
                    'quantity' => $validated['voucher_list'][$index]['quantity'],
                ]);
            }
        });

    }
}

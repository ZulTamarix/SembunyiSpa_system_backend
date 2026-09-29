<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Voucher\Voucher;
use App\Models\Voucher\Voucher_customer;
use App\Models\User;

use Illuminate\Http\Request;

class VoucherController
{
    // 1) GET — fetch all
    public function index()
    {
        return response()->json(Voucher::all());
    }

    // 2) POST
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string',
            'description' => 'required|string',
            'type' => 'required|string',
            'date_expired' => 'required|date',
            'status' => 'required|string',
            'discount_type' => 'required|string',
            'discount_value' => 'nullable|integer',
            'quantity' => 'nullable|integer',

            'selected_customer' => 'required|string',
        ]);

        // if 1 fail, all fail
        DB::transaction(function () use ($validated) {
            
            // a) Create data for 'voucher' 
           $voucher = Voucher::create([
                'code' => $validated['code'],
                'description' => $validated['description'],
                'type' => $validated['type'],
                'date_expired' => $validated['date_expired'],
                'status' => $validated['status'],
                'discount_type' => $validated['discount_type'],
                'discount_value' => $validated['discount_value'],
                'quantity' => $validated['quantity'],
            ]);

            if ($validated['selected_customer'] != 'all') {

                // i) Create 1 data for 'voucher_customer'
                Voucher_customer::create([
                    'voucher_id' => $voucher->id,
                    'user_id' => $validated['selected_customer'],
                ]);
            }
            else {

                // ii) Create all data for 'voucher_customer'
                $customers = User::where('role', 'customer')->get();
                foreach ($customers as $customer) {
                    Voucher_customer::create([
                        'voucher_id' => $voucher->id,
                        'user_id' => $customer->id,
                    ]);
                }
            }
        });

    }
}

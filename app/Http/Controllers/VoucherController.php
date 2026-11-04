<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Voucher\Voucher;
use App\Models\Voucher\Voucher_customer;
use App\Models\Log\Log_voucher;
use App\Models\User;

use Illuminate\Http\Request;

class VoucherController
{
    // 1) GET — fetch all
    public function index(Request $request)
    {
        try {
            $switch = $request->input('switch');
            $extra = $request->input('extra');
            $user_id = $request->input('user_id');

            if ($switch == 'voucher') {

                if ($extra == 'exclude inactive') {
                    return response()->json(Voucher::where('status', '!=', 'inactive')->get());
                }

                return response()->json(Voucher::all());
            }

            else if ($switch == 'customer') {
                return response()->json(Voucher_customer::with('voucher', 'log')
                                ->where('user_id', $user_id)
                                ->get());
            }

            return response()->json([
                'status' => false,
                'message' => 'Invalid switch'
            ], 400);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }


    // 2) POST
    public function store(Request $request)
    {
        $switch = $request->input('switch');

        if($switch == 'voucher') {

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

                if ($validated['selected_customer'] == 'all') {

                    // i) Create all data for 'voucher_customer'
                    $customers = User::where('role', 'customer')->get();
                    foreach ($customers as $customer) {
                        Voucher_customer::create([
                            'voucher_id' => $voucher->id,
                            'user_id' => $customer->id,
                            'quantity' => $validated['quantity'],
                            'serial_no' => $validated['serial_no'],
                            'status' => $validated['status'],
                        ]);
                    }
                }
                else if($validated['selected_customer'] == 'blank') {
                    // dont do anything
                    return;
                }
                else {
                    // ii) Create 1 data for 'voucher_customer'
                    Voucher_customer::create([
                        'voucher_id' => $voucher->id,
                        'user_id' => $validated['selected_customer'],
                        'quantity' => $validated['quantity'],
                        'serial_no' => $validated['serial_no'],
                        'status' => $validated['status'],
                    ]);
                }
            });
        }

        else if($switch == 'voucher_customer') {
        
            $validated = $request->validate([
                'voucher_id' => 'required|integer',
                'user_id' => 'required|integer',
                'quantity' => 'nullable|integer',
                'date_expired' => 'nullable|string',
                'serial_no' => 'nullable|string',
                'status' => 'nullable|string'
            ]);

            // Create data for 'voucher_customer' 
            Voucher_customer::create([
                'voucher_id' => $validated['voucher_id'],
                'user_id' => $validated['user_id'],
                'quantity' => $validated['quantity'],
                'date_expired' => $validated['date_expired'],
                'serial_no' => $validated['serial_no'],
                'status' => $validated['status'],
            ]);
        }

    }

    // 3) PUT
    public function update(Request $request, string $id)
    {
        $switch = $request->input('switch');
        $extra = $request->input('extra');

        // 1)
        if($switch == 'voucher'){

            // check if it exist
            $voucher = Voucher::findOrFail($id);

            // Validate request
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

            // 1. Update user
            $voucher->update([
                'code' => $validated['code'],
                'description' => $validated['description'],
                'type' => $validated['type'],
                'date_expired' => $validated['date_expired'],
                'status' => $validated['status'],
                'discount_type' => $validated['discount_type'],
                'discount_value' => $validated['discount_value'],
                'quantity' => $validated['quantity'],
            ]);
        }
        // 2) set quantity == 0
        else if($switch == 'customer') {
            if($extra == 'quantity') {

                // if 1 fail, all fail
                DB::transaction(function () use ($id) {
                    // check if it exist
                    $voucher_customer = Voucher_customer::findOrFail($id);

                    // 1. Update voucher_customer
                    $voucher_customer->update([
                        'status' => 'redeemed',
                        'quantity' => 0,
                    ]);

                    // 2. Add log
                    Log_voucher::create([
                        'voucher_customer_id' =>  $id,
                        'action' => "Redeem the voucher"
                    ]);
                });
            }
            else if($extra == 'serial_no') {
                
                // check if it exist
                $voucher_customer = Voucher_customer::findOrFail($id);

                // Validate request
                $validated = $request->validate([
                    'serial_no'  => 'required|string',
                ]);

                // Update voucher_customer
                $voucher_customer->update([
                    'serial_no' => $validated['serial_no'], 
                ]);
            }
        }
    }

    // 4) DELETE
    public function destroy(string $id)
    {
        $voucher = Voucher::findOrFail($id);
        $voucher->delete();
    }
}

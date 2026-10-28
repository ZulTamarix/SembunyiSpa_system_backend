<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Models\Booking\Booking;
use App\Models\Booking\Booking_selected;
use App\Models\Voucher\Voucher_customer;
use App\Models\Log\Log_booking;
use App\Models\Log\Log_voucher;
use App\Models\Roster\Roster;
use App\Models\User;
use App\Models\Room;

class BookingController
{
    // 1) GET — fetch all
    public function index(Request $request)
    {
        $switch = $request->input('switch');
        $extra = $request->input('extra');
        $currentDate = $request->input('date');

        // a)
        if($switch == 'booking') {
            return response()->json(
                Booking::with([
                        'booking_selected', 
                        'user',
                        'user_shared',
                        'package',
                        'log',
                        
                        'booking_selected.package',
                        'booking_selected.user',
                        'booking_selected.room',
                    ])
                    ->get()
                    ->map(function ($booking) {
                        return [
                            'booking' => $booking->except('booking_selected', 'user', 'user_shared', 'package', 'log'),
                            'booking_selected' => $booking->booking_selected,
                            'user' => $booking->user,
                            'user_shared' => $booking->user_shared,
                            'package' => $booking->package,
                            'log' => $booking->log
                        ];
                    })
            );
        }
        // b)
        else if($switch == 'therapist') {
            if($extra == 'currentDay') {
                return response()->json(
                    Booking::where('date_start', $currentDate)
                        ->with([
                            'booking_selected',
                            'booking_selected.package',
                            'booking_selected.user',
                            'booking_selected.room',
                        ])
                        ->get()
                );
            }
            else {
                return response()->json(
                    User::where('role', 'therapist')
                        ->with([
                            'booking_selected' => function ($query) use ($currentDate) {
                                $query->whereHas('booking', function ($query) use ($currentDate) {
                                    $query->whereDate('date_start', $currentDate);
                                });
                            },
                            'booking_selected.package',
                            'booking_selected.booking',
                            'booking_selected.booking.user',
                        ])
                        ->get()
                        ->map(function ($user) {
                            return [
                                'user' => $user->except('booking_selected'),
                                'booking_selected' => $user->booking_selected,
                            ];
                        })
                );
            }

        }
        // c)
        else if($switch == 'room') {
            return response()->json(
                Room::with([
                        'booking_selected' => function ($query) use ($currentDate) {
                            $query->whereHas('booking', function ($query) use ($currentDate) {
                                $query->whereDate('date_start', $currentDate);
                            });
                        },
                        'booking_selected.booking',
                        'booking_selected.package',
                        'booking_selected.booking',
                        'booking_selected.booking.user',
                    ])
                    ->get()
                    ->map(function ($room) {
                        return [
                            'room' => $room->except('booking_selected'),
                            'booking_selected' => $room->booking_selected,
                        ];
                    })
            );
        }

    }

    // 2) POST
    public function store(Request $request)
    {
        $switch = $request->input('switch');
        $role = $request->input('role');

        $customer_name = $request->input('customer_name');
        $customer_shared_name = $request->input('customer_shared_name');
        $package_name = $request->input('package_name');
        $voucher_customer_price_id = $request->input('voucher_customer_price_id');
        $voucher_customer_duration_id = $request->input('voucher_customer_duration_id');

        // Log::info($request);

        // Validation
        $validated = $request->validate([
            // Booking
            'booking.package_id' => $switch === 'Package'
                ? 'required|integer'
                : 'nullable|integer',

            'booking.user_id' => 'required|integer',
            'booking.user_shared_id' => 'nullable|integer',
            'booking.date_start' => 'required|date',
            'booking.time_start' => 'required|date_format:H:i',
            'booking.time_end' => 'required|date_format:H:i|after:booking.time_start',
            'booking.status' => 'required|string',
            'booking.payment' => 'required|string',
            'booking.booking_type' => 'required|string',
            'booking.remark' => 'nullable|string',
            'booking.price_original' => 'required|numeric',
            'booking.price_discount' => 'required|numeric',
            'booking.price_final' => 'required|numeric',

            // Booking selected
            'booking_selected' => 'required|array|min:1',
            'booking_selected.*.service_id' => 'nullable|integer',
            'booking_selected.*.room_id' => 'nullable|integer',
            'booking_selected.*.user_id' => 'nullable|integer',
        ]);

        DB::transaction(function () use ( $validated, $role, $customer_name, $customer_shared_name, $package_name, $voucher_customer_price_id, $voucher_customer_duration_id) {

            // 1. Create 'booking'
            $booking = Booking::create([
                'package_id' => $validated['booking']['package_id'] ?? null,
                'user_id' => $validated['booking']['user_id'],
                'user_shared_id' => $validated['booking']['user_shared_id'] ?? null,
                'date_start' => $validated['booking']['date_start'],
                'time_start' => $validated['booking']['time_start'],
                'time_end' => $validated['booking']['time_end'],
                'status' => $validated['booking']['status'],
                'payment' => $validated['booking']['payment'],
                'booking_type' => $validated['booking']['booking_type'],
                'remark' => $validated['booking']['remark'] ?? null,
                'price_original' => $validated['booking']['price_original'],
                'price_discount' => $validated['booking']['price_discount'],
                'price_final' => $validated['booking']['price_final'],
            ]);

            // 2. Create 'booking_selected'
            foreach ($validated['booking_selected'] as $selected) {
                Booking_selected::create([
                    'booking_id' => $booking->id,
                    'package_id' => $selected['service_id'],
                    'room_id' => $role === 'customer' ? null : $selected['room_id'],
                    'user_id' => $role === 'customer' ? null : ($selected['user_id'] ?? null),
                ]);
            }

            // 3. Create booking log
            Log_booking::create([
                'booking_id' => $booking->id,
                'action' => $customer_shared_name
                    ? "&bull; Booked a treatment for <strong style='color: green'>{$customer_shared_name}</strong><br/>"
                    . "&bull; Shared by <strong style='color: green'>{$customer_name}</strong>"
                    : "Booked a treatment for <strong style='color: green'>{$customer_name}</strong>",
            ]);

            // 4. Deduct vouchers
            foreach ([ $voucher_customer_price_id, $voucher_customer_duration_id] as $voucher_id) {

                if ($voucher_id === 'blank') 
                    continue;

                $voucher_customer = Voucher_customer::find((int) $voucher_id);

                if (!$voucher_customer) 
                    continue;

                if ( $voucher_customer->quantity !== 0 && $voucher_customer->quantity !== null ) 
                    $voucher_customer->decrement('quantity', 1);

                Log_voucher::create([
                    'voucher_customer_id' => $voucher_customer->id,
                    'action' => $customer_shared_name
                        ? "&bull; Use by <strong style='color: green'>{$customer_shared_name}</strong> for <strong style='color: green'>{$package_name}</strong> treatment<br/>"
                        . "&bull; Shared by <strong style='color: green'>{$customer_name}</strong>"
                        : "Use by <strong style='color: green'>{$customer_name}</strong> for <strong style='color: green'>{$package_name}</strong> treatment",
                    ]);
            }
        });
    }

    // 3) PUT
    public function update(Request $request, string $id)
    {
        $switch = $request->input('switch');
        
        // check if it exist
        $booking = Booking::findOrFail($id);

        // 1)
        if($switch == 'start') {
            $validated = $request->validate([
                'payment'  => 'required|string',
                'status'  => 'required|string',
                'recorded_time_start'  => 'required|string',
            ]);

            // Check if data already exists, if not create it
            DB::transaction(function () use ($validated, $booking) {

                $booking->update([
                    'payment' => $validated['payment'],
                    'status' => $validated['status'],
                    'recorded_time_start' => $validated['recorded_time_start'],
                    ]
                );
            
                Log_booking::create([
                    'booking_id' => $booking->id,
                    'action' => "Make payment",
                ]);
            });
        }
        // 2)
        else if($switch == 'end') {
            $validated = $request->validate([
                'status'  => 'required|string',
                'recorded_time_end'  => 'required|string',
            ]);

            // Check if data already exists, if not create it
            $booking->update([
                'status' => $validated['status'],
                'recorded_time_end' => $validated['recorded_time_end'],
                ]
            );
        }
        // 3)
        else if($switch == 'payment') {
            $validated = $request->validate([
                'payment'  => 'required|string',
            ]);
            DB::transaction(function () use ($validated, $booking) {

                // Check if data already exists, if not create it
                $booking->update([
                    'payment' => $validated['payment'],
                    ]
                );
                Log_booking::create([
                    'booking_id' => $booking->id,
                    'action' => "Make payment",
                ]);
            });
        } 
        else if($switch == 'booking') {
            
            // Validation
            $validated = $request->validate([
                // Booking
                'booking.package_id' => $switch === 'Package'
                    ? 'required|integer'
                    : 'nullable|integer',

                'booking.user_id' => 'required|integer',
                'booking.user_shared_id' => 'nullable|integer',
                'booking.date_start' => 'required|date',
                'booking.time_start' => 'required|date_format:H:i',
                'booking.time_end' => 'required|date_format:H:i|after:booking.time_start',
                'booking.status' => 'required|string',
                'booking.payment' => 'required|string',
                'booking.booking_type' => 'required|string',
                'booking.remark' => 'nullable|string',
                'booking.price_original' => 'required|numeric',
                'booking.price_discount' => 'required|numeric',
                'booking.price_final' => 'required|numeric',

                // Booking selected
                'booking_selected' => 'required|array|min:1',
                'booking_selected.*.id' => 'nullable|integer',
                'booking_selected.*.service_id' => 'nullable|integer',
                'booking_selected.*.room_id' => 'nullable|integer',
                'booking_selected.*.user_id' => 'nullable|integer',
            ]);

            DB::transaction(function () use ( $validated, $booking ) {

                // 1. Update 'booking'
                $booking->update([
                    'package_id' => $validated['booking']['package_id'] ?? null,
                    'user_id' => $validated['booking']['user_id'],
                    'user_shared_id' => $validated['booking']['user_shared_id'] ?? null,
                    'date_start' => $validated['booking']['date_start'],
                    'time_start' => $validated['booking']['time_start'],
                    'time_end' => $validated['booking']['time_end'],
                    'status' => $validated['booking']['status'],
                    'payment' => $validated['booking']['payment'],
                    'booking_type' => $validated['booking']['booking_type'],
                    'remark' => $validated['booking']['remark'] ?? null,
                    'price_original' => $validated['booking']['price_original'],
                    'price_discount' => $validated['booking']['price_discount'],
                    'price_final' => $validated['booking']['price_final'],
                ]);

                // 2. Update booking_selected
                foreach ($validated['booking_selected'] as $selected) {
                    Booking_selected::where('id', $selected['id'])
                        ->where('booking_id', $booking->id)
                        ->update([
                            'room_id' => $selected['room_id'] ?? null,
                            'user_id' => $selected['user_id'] ?? null,
                        ]);
                }
                
                // 3. Update booking log
                Log_booking::create([
                    'booking_id' => $booking->id,
                    'action' => "Confirm the booking",
                ]);
            });
        }
    }


    // BONUS
        // 1) GET available therapist
        public function getTherapist(Request $request)
        {
            // Log::info($therapist_list);

            $date = $request->date;
            $time_start = $request->time_start;
            $time_end = $request->time_end;

            $therapist_list = $request->therapist_list;
            $room_list = $request->room_list;

            $available_therapist = 
                Roster::with([
                    'shift',
                    'booking_selected.booking'
                ])
                ->whereDate('date', $date)
                ->whereIn('user_id', $therapist_list)
                ->whereNotNull('roster_shift_id')
                ->whereNull('roster_leave_id')

                // a) Check roster shift covers requested time
                ->whereHas('shift', function ($query) use ($time_start, $time_end) {
                    $query->where('time_start', '<=', $time_start)
                        ->where('time_end', '>=', $time_end);
                })

                // b) Remove entire roster if it has a conflicting booking
                ->whereDoesntHave('booking_selected.booking', function ($query) use ($date, $time_start, $time_end) {
                    $query->whereDate('date_start', $date)
                        ->where('time_start', '<', $time_end)
                        ->where('time_end', '>', $time_start);
                })

                ->get()
                ->pluck('user');
            $available_room = 
                Room::whereIn('id', $room_list)
                ->whereDoesntHave('booking_selected.booking', function ($query) use ($date, $time_start, $time_end) {
                    $query->whereDate('date_start', $date)
                        ->where('time_start', '<', $time_end)
                        ->where('time_end', '>', $time_start);
                })
                ->get();

            // return response()->json($available_therapist, $available_therapist);
            return response()->json([
                'therapist' => $available_therapist,
                'room' => $available_room
            ]);

        }
}

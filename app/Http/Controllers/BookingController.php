<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Booking\Booking;
use App\Models\Booking\Booking_selected;
use App\Models\User;
use App\Models\Room;

class BookingController
{
    // 1) GET — fetch all
    public function index(Request $request)
    {
        $switch = $request->input('switch');
        $currentDate = $request->input('date');
        // a)
        if($switch == 'booking') {
            return response()->json(
                Booking::with([
                        'user',
                        'booking_selected', 
                        
                        'booking_selected.package',
                        'booking_selected.user',
                        'booking_selected.room',
                    ])
                    ->get()
                    ->map(function ($booking) {
                        return [
                            'booking' => $booking->except('booking_selected', 'user'),
                            'booking_selected' => $booking->booking_selected,
                            'user' => $booking->user
                        ];
                    })
            );
        }
        // b)
        else if($switch == 'therapist') {
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
        // validation
        $validated = $request->validate([
            // a) booking
            'booking.package_id' => 'nullable|integer',
            'booking.user_id' => 'nullable|integer',
            'booking.date_start' => 'required|date',
            'booking.time_start' => 'required|date_format:H:i',
            'booking.time_end' => 'required|date_format:H:i|after:time_start',
            'booking.status' => 'required|string',
            'booking.payment' => 'required|string',
            'booking.booking_type' => 'required|string',
            'booking.remark' => 'nullable|string',
            
            // b) membership_privilege
            // 'booking_id' => 'required|integer',
            'booking_selected.service_id' => 'required|integer',
            'booking_selected.room_id' => 'required|integer',
            'booking_selected.user_id' => 'nullable|integer',
        ]);

        // if 1 fail, all fail
        DB::transaction(function () use ($validated) {
            // a) Create data for 'membership' 
            $booking = Booking::create(
                [
                    'package_id' => $validated['booking']['package_id'],
                    'user_id' => $validated['booking']['user_id'],
                    'date_start' => $validated['booking']['date_start'],
                    'time_start' => $validated['booking']['time_start'],
                    'time_end' => $validated['booking']['time_end'],
                    'status' => $validated['booking']['status'],
                    'payment' => $validated['booking']['payment'],
                    'booking_type' => $validated['booking']['booking_type'],
                    'remark' => $validated['booking']['remark'] ?? null,
                ]
            );
            // 2. Create booking
            // foreach ($validated['privilege_list'] as $index => $list) {
                // Create booking
                Booking_selected::create([
                    'booking_id' => $booking->id,
                    'package_id' => $validated['booking_selected']['service_id'],
                    'room_id' => $validated['booking_selected']['room_id'],
                    'user_id' => $validated['booking_selected']['user_id'],
                ]);
            // }
        });

    }
}

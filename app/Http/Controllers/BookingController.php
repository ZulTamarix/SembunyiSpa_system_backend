<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Booking\Booking;
use App\Models\Booking\Booking_selected;

class BookingController
{

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

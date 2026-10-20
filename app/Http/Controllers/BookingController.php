<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Models\Booking\Booking;
use App\Models\Booking\Booking_selected;
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

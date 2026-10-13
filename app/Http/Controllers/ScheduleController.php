<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Room;

class ScheduleController
{
    // 1) GET — fetch all
    public function index(Request $request)
    {
        $switch = $request->input('switch');
        $currentDate = $request->input('date');

        // a)
        if($switch == 'therapist') {
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
        // b)
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
}

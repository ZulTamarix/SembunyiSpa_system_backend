<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roster\Roster;
use Illuminate\Support\Facades\Log;

class AvailabilityController
{
    // 1) GET
    public function getTherapist(Request $request)
    {
        // Log::info($request->all());

        $date = $request->date;
        $time_start = $request->time_start;
        $time_end = $request->time_end;
        $therapist_list = $request->therapist_list;
        // Log::info($date);
        // Log::info($time_start);
        // Log::info($time_end);
        Log::info($therapist_list);


        $available = Roster::with('shift')
            ->whereDate('date', $date)
            ->whereIn('user_id', $therapist_list)
            ->whereNotNull('roster_shift_id')
            ->whereNull('roster_leave_id')
            ->whereHas('shift', function ($query) use ($time_start, $time_end) {
                $query->where('time_start', '<=', $time_start)
                      ->where('time_end', '>=', $time_end);
            })
            ->get()
            ->pluck('user');
        

        // Log::info(json_encode($available));
        Log::info(json_encode($available->toArray(), JSON_PRETTY_PRINT));
        return response()->json($available);
    }
}

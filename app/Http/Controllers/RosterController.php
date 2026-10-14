<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Roster\Roster_shift;
use App\Models\Roster\Roster_leave;
use App\Models\Roster\Roster;
use App\Models\Roster\Roster_adjustment;
// use Illuminate\Support\Facades\Log;

class RosterController
{
    // 1) GET — fetch all
    public function index(Request $request)
    {
        $switch = $request->input('switch');
        $currentYear = $request->input('currentYear');
        $currentMonth = $request->input('currentMonth');
        // Log::info('Current Year = ' . $currentYear);
        // Log::info('Current Month = ' . $currentMonth);

        // 1) shift
        if ($switch == 'shift') {
            return response()->json(Roster_shift::all());
        }
        // 2) leave
        else if ($switch == 'leave') {
            return response()->json(Roster_leave::all());
        }
        // 3) roster
        else if ($switch == 'roster') {
            // return response()->json(Roster::all());
            return response()->json(
                // Roster::with(['shift', 'leave'])->get()->map(function ($item) {

                Roster::with(['shift', 'leave', 'adjustment'])
                    ->whereMonth('date', $currentMonth)
                    ->whereYear('date', $currentYear)
                    ->get()
                    ->map(function ($item) {
                    return [
                        'roster' => $item,
                        'roster_leave' => $item->leave,
                        'roster_shift' => $item->shift,
                        'roster_adjustment' => $item->adjustment,
                    ];
                }),
            );
        }
    }
    // 2) POST
    public function store(Request $request)
    {
        $switch = $request->input('switch');

        // 1) shift
        if ($switch == 'shift') {
            // validation
            $validated = $request->validate([
                'icon' => 'required|integer',
                'time_start' => 'required|date_format:H:i',
                'time_end' => 'required|date_format:H:i',
            ]);

            // Create data
            Roster_shift::create(
                [
                    'icon' => $validated['icon'],
                    'time_start' => $validated['time_start'],
                    'time_end' => $validated['time_end'],
                ]
            );
        }
        // 2) leave
        else if ($switch == 'leave') {
            // validation
            $validated = $request->validate([
                'icon' => 'required|string',
                'description' => 'required|string',
            ]);

            // Create data
            Roster_leave::create(
                [
                    'icon' => $validated['icon'],
                    'description' => $validated['description'],
                ]
            );
        }
        
        // 3) roster
        else if ($switch == 'roster') {
            // validation
            $validated = $request->validate([
                // a) roster 
                'date' => 'required|string',
                'user_id' => 'required|integer',
                'roster_shift_id' => 'nullable|integer',
                'roster_leave_id' => 'nullable|integer',

                // b) adjustment
                'adjustment_list' => 'sometimes|nullable|array',
                'adjustment_list.*.type' => 'required|string',
                'adjustment_list.*.time_start' => 'required|string',
                'adjustment_list.*.time_end' => 'required|string',
                'adjustment_list.*.reason' => 'required|string',
            ]);
            
            DB::transaction(function () use ($validated) {

                // Create (roster)
                $roster = Roster::updateOrCreate(
                    [
                        'date' => $validated['date'],
                        'user_id' => $validated['user_id'],
                    ],
                    [
                        'roster_shift_id' => $validated['roster_shift_id'],
                        'roster_leave_id' => $validated['roster_leave_id'],
                    ]
                );

                // Create (adjustment)
                if (!empty($validated['adjustment_list'])) {
                    foreach ($validated['adjustment_list'] as $adjustment) {
                        Roster_adjustment::create([
                            'roster_id' => $roster->id,
                            'type' => $adjustment['type'],
                            'time_start' => $adjustment['time_start'],
                            'time_end' => $adjustment['time_end'],
                            'reason' => $adjustment['reason'],
                        ]);
                    }
                }
            });
        }
    }
}

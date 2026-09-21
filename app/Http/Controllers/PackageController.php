<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package\Package;
use App\Models\Package\Package_detail;
use App\Models\Package\Package_therapist;
use App\Models\Package\Package_room;

class PackageController
{
    // 1) GET — fetch all
public function index()
    {
        return response()->json(
            Package::with('detail', 'therapist', 'room')->get()->map(function ($user) {
                return [
                    'MAIN' => $user->except('detail', 'therapist', 'room'),
                    'detail' => $user-> detail,
                    'therapist' => $user-> therapist,
                    'room' => $user-> room,
                ];
            })
        );
    }

    // 2) POST
    public function store(Request $request)
    {
        // validation
        $validated = $request->validate([
            'poster' => 'required|string',
            'title' => 'required|string',
            'type' => 'required|string',
            'description' => 'required|string',
            'duration' => 'required|integer',
            'price' => 'required|numeric',
            'gender' => 'required|string',
            
            'detail_list' => 'nullable|array',
            'detail_list.*' => 'required|string',
            'therapist_list' => 'required|array',
            'therapist_list.*' => 'required|string',
            'room_list' => 'required|array',
            'room_list.*' => 'required|string',
        ]);

        // a) Create data for 'package' 
        $package = Package::create(
            [
                'poster' => $validated['poster'],
                'title' => $validated['title'],
                'type' => $validated['type'],
                'description' => $validated['description'],
                'duration' => $validated['duration'],
                'price' => $validated['price'],
                'gender' => $validated['gender'],
            ]
        );
        // b) Create data for 'package_detail'
        foreach ($validated['detail_list'] as $detail) {
            Package_detail::create([
                'package_id' => $package->id,
                'detail' => $detail,
            ]);
        }
        // c) Create data for 'package_therapist'
        foreach ($validated['therapist_list'] as $therapist) {
            Package_therapist::create([
                'package_id' => $package->id,
                'user_therapist_id' => $therapist,
            ]);
        }
        // d) Create data for 'package_room'
        foreach ($validated['room_list'] as $room) {
            Package_room::create([
                'package_id' => $package->id,
                'room_id' => $room,
            ]);
        }
    }
}

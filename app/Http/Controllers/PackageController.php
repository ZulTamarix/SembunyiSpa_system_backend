<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            Package::with('detail', 'therapist', 'room')->get()->map(function ($package) {
                return [
                    'MAIN_DATA' => $package->except('detail', 'therapist', 'room'),
                    'detail' => $package-> detail,
                    'therapist' => $package-> therapist,
                    'room' => $package-> room,
                ];
            })
        );
    }

    // 2) POST
    public function store(Request $request)
    {
        // a) Convert JSON strings back into arrays
        $request->merge([
            'detail_list' => json_decode($request->detail_list, true),
            'therapist_list' => json_decode($request->therapist_list, true),
            'room_list' => json_decode($request->room_list, true),
        ]);

        // b) Validation
        $validated = $request->validate([
            'poster' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'title' => 'required|string',
            'type' => 'required|string',
            'description' => 'required|string',
            'duration' => 'required|integer',
            'price' => 'required|numeric',
            'gender' => 'required|string',
            
            'detail_list' => 'nullable|array',
            'detail_list.*' => 'required|string',
            'therapist_list' => 'required|array',
            'therapist_list.*' => 'required|integer',
            'room_list' => 'required|array',
            'room_list.*' => 'required|integer',
        ]);

        
        // if 1 fail, all fail
        DB::transaction(function () use ($validated) {


            // c) Store image in public/Package
            $file = $validated['poster'];
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(
                public_path('Package'),
                $filename
            );
            // Path to store in database
            $posterPath = 'Package/' . $filename;

             // d) Create data for 'package' 
            $package = Package::create(
                [
                    'poster' => $posterPath,
                    'title' => $validated['title'],
                    'type' => $validated['type'],
                    'description' => $validated['description'],
                    'duration' => $validated['duration'],
                    'price' => $validated['price'],
                    'gender' => $validated['gender'],
                ]
            );
            // e) Create data for 'package_detail'
            foreach ($validated['detail_list'] as $detail) {
                Package_detail::create([
                    'package_id' => $package->id,
                    'detail' => $detail,
                ]);
            }
            // f) Create data for 'package_therapist'
            foreach ($validated['therapist_list'] as $therapist) {
                Package_therapist::create([
                    'package_id' => $package->id,
                    'user_therapist_id' => $therapist,
                ]);
            }
            // g) Create data for 'package_room'
            foreach ($validated['room_list'] as $room) {
                Package_room::create([
                    'package_id' => $package->id,
                    'room_id' => $room,
                ]);
            }
        });
    }
}

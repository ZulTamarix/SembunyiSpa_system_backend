<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Package\Package;
use App\Models\Package\Package_service;
use App\Models\Package\Service;
use App\Models\Package\Service_category;
use App\Models\Package\Service_therapist;
use App\Models\Package\Service_room;

class PackageController
{
    // 1) GET — fetch all
    public function index(Request $request)
    {
        $switch = $request->input('switch');

        // a)
        if($switch == 'package') {
            return response()->json(
                Package::with('package_service')->get()->map(function ($package) {
                    return [
                        'package' => $package->except('package_service'),
                        'package_service' => $package->package_service,
                    ];
                })
            );
        }
        // b)
        else if($switch == 'service') {
            return response()->json(
                Service::with('category')->get()->map(function ($service) {
                    return [
                        'service' => $service->except('category'),
                        'service_category' => $service->category,
                    ];
                })
            );
        }
        // c)
        else if($switch == 'service_category') {
            return response()->json(Service_category::all());
        }

    }

    // 2) POST
    public function store(Request $request)
    {
        $switch = $request->input('switch');
        
        // a)
        if($switch == 'package') {

            // a) Convert JSON strings back into arrays
            $request->merge([
                'service_list' => json_decode($request->service_list, true),
            ]);

            // b) Validation
            $validated = $request->validate([
                'poster' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
                'title' => 'required|string',
                'description' => 'required|string',
                'duration' => 'required|integer',
                'price' => 'required|numeric',
                'gender' => 'required|string',
                'detail' => 'required|string',

                'service_list' => 'required|array',
                'service_list.*' => 'required|integer',
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
                        'description' => $validated['description'],
                        'duration' => $validated['duration'],
                        'price' => $validated['price'],
                        'gender' => $validated['gender'],
                        'detail' => $validated['detail'],
                    ]
                );
                // e) Create data for 'package_detail'
                foreach ($validated['service_list'] as $service) {
                    Package_service::create([
                        'package_id' => $package->id,
                        'service_id' => $service,
                    ]);
                }
            });
        }

        // b) 
        else if ($switch == 'service') {
            

            // a) Convert JSON strings back into arrays
            $request->merge([
                'therapist_list' => json_decode($request->therapist_list, true),
                'room_list' => json_decode($request->room_list, true),
            ]);

            // b) Validation
            $validated = $request->validate([
                'poster' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
                'title' => 'required|string',
                'description' => 'required|string',
                'duration' => 'required|integer',
                'price' => 'required|numeric',
                'gender' => 'required|string',
                'detail' => 'required|string',

                'service_category_id' => 'required|integer',
                'is_standalone' => 'required|boolean',
                
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
                    public_path('Service'),
                    $filename
                );
                // Path to store in database
                $posterPath = 'Service/' . $filename;

                // d) Create data for 'package' 
                $service = Service::create(
                    [
                        'poster' => $posterPath,
                        'title' => $validated['title'],
                        'description' => $validated['description'],
                        'duration' => $validated['duration'],
                        'price' => $validated['price'],
                        'gender' => $validated['gender'],
                        'detail' => $validated['detail'],
                        'service_category_id' => $validated['service_category_id'],
                        'is_standalone' => $validated['is_standalone'],
                    ]
                );
                // f) Create data for 'service_therapist'
                foreach ($validated['therapist_list'] as $therapist) {
                    Service_therapist::create([
                        'service_id' => $service->id,
                        'user_id' => $therapist,
                    ]);
                }
                // g) Create data for 'service_room'
                foreach ($validated['room_list'] as $room) {
                    Service_room::create([
                        'service_id' => $service->id,
                        'room_id' => $room,
                    ]);
                }
            });
        }

        // c)
        else if ($switch == 'service_category') {

            $validated = $request->validate([
                'name'  => 'required|string',
            ]);

            // Create
            Service_category::Create(
                [
                    'name' => $validated['name'],
                ]
            );
        }

    }
}

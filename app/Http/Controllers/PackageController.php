<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Package\Package;
use App\Models\Package\Package_service;
use App\Models\Package\Package_category;
use App\Models\Package\Package_therapist;
use App\Models\Package\Package_room;

class PackageController
{
    // 1) GET — fetch all
    public function index(Request $request)
    {
        try {
            $switch = $request->input('switch');
            $extra = $request->input('extra');

            // a)
            if ($switch == 'package') {
                return response()->json(
                    Package::where('type', 'package')
                        ->with('package_category', 'package_service', 'package_service.room', 'package_service.therapist')
                        ->get()
                        ->map(function ($package) {
                            return [
                                'package' => $package->except('package_service', 'package_service.room', 'package_service.therapist', 'package_category'),
                                'package_category' => $package->package_category,
                                'package_service' => $package->package_service,
                            ];
                        })
                );
            }
            // b)
            else if ($switch == 'service') {
                $query = Package::where('type', 'service');

                if ($extra == 'for_booking') {
                    $query->where('is_standalone', '!=', 0);
                    
                    return response()->json(
                        $query->with('package_category', 'package_therapist', 'package_therapist.therapist', 'package_room', 'package_room.room')
                            ->get()
                            ->map(function ($package) {
                                return [
                                    'package' => $package->except('package_category', 'package_therapist', 'package_therapist.therapist', 'package_room', 'package_room.room'),
                                    'package_category' => $package->package_category,
                                    'package_therapist' => $package->package_therapist,
                                    'package_room' => $package->package_room,
                                ];
                            })
                    );
                }
                else {
                    return response()->json(
                        $query->with('package_category', 'package_therapist', 'package_therapist.therapist', 'package_room', 'package_room.room')
                            ->get()
                            ->map(function ($package) {
                                return [
                                    'package' => $package->except('package_category', 'package_therapist', 'package_therapist.therapist', 'package_room', 'package_room.room'),
                                    'package_category' => $package->package_category,
                                    'package_therapist' => $package->package_therapist,
                                    'package_room' => $package->package_room,
                                ];
                            })
                    );
                }
            }
            // c)
            else if ($switch == 'category') {
                return response()->json(Package_category::all());
            }

            return response()->json([
                'status' => false,
                'message' => 'Invalid switch'
            ], 400);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
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
                'type' => 'required|string',
                'detail' => 'required|string',

                'package_category_id' => 'required|integer',
                
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
                        'type' => $validated['type'],
                        'detail' => $validated['detail'],
                        'package_category_id' => $validated['package_category_id'],
                    ]
                );
                // e) Create data for 'package_detail'
                foreach ($validated['service_list'] as $index => $service) {
                    Package_service::create([
                        'package_id' => $package->id,
                        'service_id' => $service,
                        'order' => $index + 1
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
                'type' => 'required|string',
                'detail' => 'required|string',

                'package_category_id' => 'required|integer',
                'is_standalone' => 'nullable|boolean',
                
                'therapist_list' => 'required|array',
                'therapist_list.*' => 'required|integer',
                'room_list' => 'required|array',
                'room_list.*' => 'required|integer',
            ]);
            // convert to integer
            // $validated['package_category_id'] = (int) $validated['package_category_id'];

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
                $service = Package::create(
                    [
                        'poster' => $posterPath,
                        'title' => $validated['title'],
                        'description' => $validated['description'],
                        'duration' => $validated['duration'],
                        'price' => $validated['price'],
                        'gender' => $validated['gender'],
                        'type' => $validated['type'],
                        'detail' => $validated['detail'],
                        'package_category_id' => $validated['package_category_id'],
                        'is_standalone' => $validated['is_standalone'],
                    ]
                );
                // f) Create data for 'service_therapist'
                foreach ($validated['therapist_list'] as $therapist) {
                    Package_therapist::create([
                        'package_id' => $service->id,
                        'user_id' => $therapist,
                    ]);
                }
                // g) Create data for 'service_room'
                foreach ($validated['room_list'] as $room) {
                    Package_room::create([
                        'package_id' => $service->id,
                        'room_id' => $room,
                    ]);
                }
            });
        }

        // c)
        else if ($switch == 'category') {

            $validated = $request->validate([
                'name'  => 'required|string',
            ]);

            // Create
            Package_category::Create(
                [
                    'name' => $validated['name'],
                ]
            );
        }

    }

    // 3) PUT
    public function update(Request $request, string $id)
    {
        $switch = $request->input('switch');

        // 1) Package
        if ($switch == 'package') {

            // a) Convert JSON strings back into arrays
            $request->merge([
                'service_list' => json_decode($request->service_list, true),
            ]);

            // b) Find existing package
            $package = Package::findOrFail($id);

            // c) Validation
            $validated = $request->validate([
                'poster' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
                'title' => 'required|string',
                'description' => 'required|string',
                'duration' => 'required|integer',
                'price' => 'required|numeric',
                'gender' => 'required|string',
                'type' => 'required|string',
                'detail' => 'required|string',
                'package_category_id' => 'required|integer',

                'service_list' => 'required|array',
                'service_list.*' => 'required|integer',
            ]);

            $oldPoster = null;

            // d) Update
            DB::transaction(function () use ($validated, $package, &$oldPoster) {

                // Replace image if uploaded
                if (isset($validated['poster'])) {

                    // Store old image path
                    $oldPoster = $package->poster;

                    // Upload new image
                    $file = $validated['poster'];
                    $filename = time() . '_' . $file->getClientOriginalName();

                    $file->move(
                        public_path('Package'),
                        $filename
                    );

                    $posterPath = 'Package/' . $filename;

                } else {
                    // Keep existing image
                    $posterPath = $package->poster;
                }

                // Update package
                $package->update([
                    'poster' => $posterPath,
                    'title' => $validated['title'],
                    'description' => $validated['description'],
                    'duration' => $validated['duration'],
                    'price' => $validated['price'],
                    'gender' => $validated['gender'],
                    'type' => $validated['type'],
                    'detail' => $validated['detail'],
                    'package_category_id' => $validated['package_category_id'],
                ]);

                // Delete existing package_service records
                Package_service::where('package_id', $package->id)->delete();

                // Recreate package_service records
                foreach ($validated['service_list'] as $index => $service) {
                    Package_service::create([
                        'package_id' => $package->id,
                        'service_id' => $service,
                        'order' => $index + 1
                    ]);
                }
            });

            // Delete old image AFTER successful transaction
            if ($oldPoster) {
                $oldImage = public_path($oldPoster);

                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }
        }

        // 2) Service
        else if ($switch == 'service') {

            // a) Convert JSON strings back into arrays
            $request->merge([
                'therapist_list' => json_decode($request->therapist_list, true),
                'room_list' => json_decode($request->room_list, true),
            ]);

            // b) Find existing service
            $service = Package::findOrFail($id);

            // c) Validation
            $validated = $request->validate([
                'poster' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
                'title' => 'required|string',
                'description' => 'required|string',
                'duration' => 'required|integer',
                'price' => 'required|numeric',
                'gender' => 'required|string',
                'type' => 'required|string',
                'detail' => 'required|string',

                'package_category_id' => 'required|integer',
                'is_standalone' => 'nullable|boolean',

                'therapist_list' => 'required|array',
                'therapist_list.*' => 'required|integer',

                'room_list' => 'required|array',
                'room_list.*' => 'required|integer',
            ]);

            $oldPoster = null;

            // d) Update
            DB::transaction(function () use ($validated, $service, &$oldPoster) {

                // Replace image if uploaded
                if (isset($validated['poster'])) {

                    // Store old image path
                    $oldPoster = $service->poster;

                    // Upload new image
                    $file = $validated['poster'];
                    $filename = time() . '_' . $file->getClientOriginalName();

                    $file->move(
                        public_path('Service'),
                        $filename
                    );

                    $posterPath = 'Service/' . $filename;

                } else {
                    // Keep existing image
                    $posterPath = $service->poster;
                }

                // Update service
                $service->update([
                    'poster' => $posterPath,
                    'title' => $validated['title'],
                    'description' => $validated['description'],
                    'duration' => $validated['duration'],
                    'price' => $validated['price'],
                    'gender' => $validated['gender'],
                    'type' => $validated['type'],
                    'detail' => $validated['detail'],
                    'package_category_id' => $validated['package_category_id'],
                    'is_standalone' => $validated['is_standalone'],
                ]);

                // Delete existing service_therapist records
                Package_therapist::where('package_id', $service->id)->delete();

                // Recreate service_therapist records
                foreach ($validated['therapist_list'] as $therapist) {
                    Package_therapist::create([
                        'package_id' => $service->id,
                        'user_id' => $therapist,
                    ]);
                }

                // Delete existing service_room records
                Package_room::where('package_id', $service->id)->delete();

                // Recreate service_room records
                foreach ($validated['room_list'] as $room) {
                    Package_room::create([
                        'package_id' => $service->id,
                        'room_id' => $room,
                    ]);
                }
            });

            // Delete old image AFTER successful transaction
            if ($oldPoster) {
                $oldImage = public_path($oldPoster);

                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }
        }

        // 3) Category
        else if ($switch == 'category') {

            $package_category = Package_category::findOrFail($id);

            $validated = $request->validate([
                'name' => 'required|string',
            ]);

            $package_category->update([
                'name' => $validated['name'],
            ]);
        }

    }
    
    // 4) DELETE
    public function destroy(Request $request,string $id)
    {
        $switch = $request->input('switch');

        // 1)
        if($switch == 'package'){
        }
        // 2)
        else if($switch == 'service'){
        }
        // 3)
        else if($switch == 'category'){
            $package_category = Package_category::findOrFail($id);
            $package_category->delete();
        }
    }
}

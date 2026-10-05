<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController
{
    // 1) GET — fetch all
    public function index()
    {
        return response()->json(Banner::all());
    }

    // 2) POST
    public function store(Request $request)
    {

        // a) Validation
        $validated = $request->validate([
            'poster' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'title' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|string',
            'date_expired' => 'required|string',
        ]);


        // b) Store image in public/Package
        $file = $validated['poster'];
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(
            public_path('Banner'),
            $filename
        );
        // Path to store in database
        $posterPath = 'Banner/' . $filename;

        // c) Create data for 'banner' 
        Banner::create(
            [
                'poster' => $posterPath,
                'title' => $validated['title'],
                'description' => $validated['description'],
                'status' => $validated['status'],
                'date_expired' => $validated['date_expired'],
            ]
        );

    }
}

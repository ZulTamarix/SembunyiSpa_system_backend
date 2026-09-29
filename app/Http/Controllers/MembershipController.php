<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Membership\Membership;
use App\Models\Membership\Membership_privilege;

class MembershipController
{
    // 1) GET — fetch all
    public function index()
    {
        return response()->json(
            Membership::with('privilege')->get()->map(function ($membership) {
                return [
                    'membership' => $membership->except('privilege'),
                    'membership_privilege' => $membership->privilege
                ];
            })
        );
    }

    // 2) POST
    public function store(Request $request)
    {
        // validation
        $validated = $request->validate([
            'tier' => 'required|string',
            
            'privilege_list' => 'required|array',
            'privilege_list.*' => 'required|string',
        ]);

        // if 1 fail, all fail
        DB::transaction(function () use ($validated) {
            // a) Create data for 'membership' 
            $membership = Membership::create(
                [
                    'tier' => $validated['tier'],
                ]
            );
            // b) Create data for 'package_privilege'
            foreach ($validated['privilege_list'] as $list) {
                Membership_privilege::create([
                    'membership_id' => $membership->id,
                    'list' => $list,
                ]);
            }
        });
    }
}

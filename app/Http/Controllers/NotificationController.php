<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use App\Models\User;
use App\Models\Notification\Notification;
use App\Models\Notification\Notification_customer;

class NotificationController
{
    // 1) GET — fetch all
    public function index()
    {
        return response()->json(Notification::all());

    }

    // 2) POST
    public function store(Request $request)
    {
        $validated = $request->validate([
            'role'  => 'required|string',
            'title'  => 'required|string',
            'description'  => 'required|string',
        ]);

        // if 1 fail, all fail
        DB::transaction(function () use ($validated) {

            // 1. Create notification
            $notification = Notification::create([
                'role'        => $validated['role'],
                'title'       => $validated['title'],
                'description' => $validated['description'],
            ]);

            // 2. Get all users based on role
            $user_ids = User::where('role', $validated['role'])
                ->pluck('id');

            // 3. Create notification_customer for every user
            foreach ($user_ids as $user_id) {
                Notification_customer::create([
                    'notification_id' => $notification->id,
                    'user_id'         => $user_id,
                ]);
            }

            // Mail::raw($validated['description'], function ($message) use ($validated, $user) {
            //     $message->to($user->email)
            //             ->subject($validated['title']);
            // });
        });
    }

    // 3) PUT
    public function update(Request $request, string $id)
    {
        // check if it exist
        $notification = Notification::findOrFail($id);
        
        $validated = $request->validate([
            'role'  => 'required|string',
            'title'  => 'required|string',
            'description'  => 'required|string',
        ]);

        // Check if data already exists, if not create it
        $notification->update([
            'role' => $validated['role'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            ]
        );
    }

    // 4) DELETE
    public function destroy(string $id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();
    }
}

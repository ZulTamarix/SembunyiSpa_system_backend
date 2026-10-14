<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class NotificationController
{
    // 1) GET — fetch all
    public function index()
    {
        return response()->json(
            Notification::with('user')->get()->map(function ($notification) {
                return [
                    'notification' => $notification->except('user'),
                    'user' => $notification->user
                ];
            })
        );
    }

    // 2) POST
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'  => 'required|exists:user,id',
            'type'  => 'required|string',
            'title'  => 'required|string',
            'description'  => 'required|string',
        ]);
        $user = User::findOrFail($validated['user_id']);    

        // if 1 fail, all fail
        DB::transaction(function () use ($validated, $user) {
            Notification::Create(
                [
                    'user_id' => $validated['user_id'],
                    'type' => $validated['type'],
                    'title' => $validated['title'],
                    'description' => $validated['description'],
                ]
            );

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
            'user_id'  => 'required|exists:user,id',
            'type'  => 'required|string',
            'title'  => 'required|string',
            'description'  => 'required|string',
        ]);

        // Check if data already exists, if not create it
        $notification->update([
            'user_id' => $validated['user_id'],
            'type' => $validated['type'],
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

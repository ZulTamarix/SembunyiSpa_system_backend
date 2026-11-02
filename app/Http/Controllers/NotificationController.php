<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

use App\Models\User;
use App\Models\Notification;

class NotificationController
{
    // 1) GET — fetch all
    public function index()
    {
        $notifications = Notification::with('user:id,role')
            ->orderBy('id')
            ->get()
            ->unique(function ($notification) {
                return $notification->created_at . '|' . $notification->title;
            })
            ->values();

        return response()->json($notifications);
    }

    // 2) POST
    public function store(Request $request)
    {
        Log::info($request);

        $role = $request->input('role');
        $validated = $request->validate([
            'title'       => 'required|string',
            'description' => 'required|string',
        ]);

        // if 1 fail, all fail
        DB::transaction(function () use ($validated, $role) {

            // Get all user IDs with the selected role
            $userIds = User::where('role', $role)->pluck('id');
            Log::info($userIds);

            // Create notification for each user
            foreach ($userIds as $userId) {
                Notification::create([
                    'user_id'     => $userId,
                    'title'       => $validated['title'],
                    'description' => $validated['description'],
                ]);
            }

            return response()->json([
                'status'  => true,
                'message' => 'Notification created successfully',
            ]);
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

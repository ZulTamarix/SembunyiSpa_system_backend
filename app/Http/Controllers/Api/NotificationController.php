<?php

namespace App\Http\Controllers\Api;

use App\Services\FirebaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

use App\Models\User_token;
use App\Models\Notification;


class NotificationController
{
    protected FirebaseService $firebase;

    public function __construct(FirebaseService $firebase)
    {
        $this->firebase = $firebase;
    }

    public function sendToUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|array|min:1',
            'user_id.*' => 'required',
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        try {

            $results = [];
            $total_success = 0;
            $total_failed = 0;

            foreach ($request->user_id as $user_id) {

                // 1. Get all device tokens belonging to this user
                $tokens = User_token::where('user_id', $user_id)
                    ->pluck('token')
                    ->filter()
                    ->unique();

                if ($tokens->isEmpty()) {
                    $results[] = [
                        'user_id' => $user_id,
                        'status' => false,
                        'message' => 'No device token found.',
                        'success' => 0,
                        'failed' => 0,
                    ];

                    continue;
                }

                // 2. Save notification into Notification table
                $notificationId = Notification::insertGetId([
                    'user_id' => $user_id,
                    'title' => $request->title,
                    'description' => $request->description,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // 3. Send notification to each device
                $success = 0;
                $failed = 0;

                foreach ($tokens as $token) {

                    try {

                        $messageId = $this->firebase->sendNotification(
                            $token,
                            $request->title,
                            $request->description,
                            [
                                'notification_id' => (string) $notificationId,
                                'type' => 'general',
                            ]
                        );

                        $success++;
Log::info('FCM notification sent successfully', [
    'user_id' => $user_id,
    'token' => substr($token, 0, 15) . '...',
    'firebase_message_id' => $messageId,
]);
                    } catch (Throwable $e) {

                        $failed++;

                        Log::error('FCM notification failed', [
                            'user_id' => $user_id,
                            'error' => $e->getMessage(),
                        ]);
                    }
                }

                $total_success += $success;
                $total_failed += $failed;

                $results[] = [
                    'user_id' => $user_id,
                    'status' => $success > 0,
                    'notification_id' => $notificationId,
                    'total_devices' => $tokens->count(),
                    'success' => $success,
                    'failed' => $failed,
                ];
            }

            return response()->json([
                'status' => true,
                'message' => 'Notification processing completed.',
                'total_users' => count($request->user_id),
                'total_success' => $total_success,
                'total_failed' => $total_failed,
                'results' => $results,
            ]);

        } catch (Throwable $e) {

            Log::error('Multiple notification error', [
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Unable to send notification.'
            ], 500);
        }
    }
 
}

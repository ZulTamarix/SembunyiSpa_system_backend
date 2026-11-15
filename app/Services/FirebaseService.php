<?php

namespace App\Services;

use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification as FcmNotification;

class FirebaseService
{
    protected Messaging $messaging;

    public function __construct(Messaging $messaging)
    {
        $this->messaging = $messaging;
    }


    public function sendNotification(
        string $token,
        string $title,
        string $body,
        array $data = []
    ) {
        $message = CloudMessage::new()
            ->withToken($token)
            ->withNotification(
                FcmNotification::create($title, $body)
            )
            ->withData(
                array_map('strval', $data)
            );

        return $this->messaging->send($message);
    }

}

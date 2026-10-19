<?php

namespace App\Models\Notification;

use Illuminate\Database\Eloquent\Model;

class Notification_customer extends Model
{
    protected $table = 'notification_customer'; // 👈 database name
    protected $fillable = [
        'notification_id',
        'user_id',
    ];
}

<?php

namespace App\Models\Booking;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'booking'; // 👈 database name
    protected $fillable = [
        'package_id',
        'user_id',
        'date_start',
        'time_start',
        'time_end',
        'user_id',
        'room_id',
        'status',
        'payment',
        'booking_type',
        'remark'
    ];
}

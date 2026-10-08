<?php

namespace App\Models\Booking;

use Illuminate\Database\Eloquent\Model;

class Booking_selected extends Model
{
    protected $table = 'booking_selected'; // 👈 database name
    protected $fillable = [
        'booking_id',
        'package_id',
        'room_id',
        'user_id'
    ];
}

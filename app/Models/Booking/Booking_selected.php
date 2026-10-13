<?php

namespace App\Models\Booking;

use Illuminate\Database\Eloquent\Model;
use App\Models\Package\Package;
use App\Models\Room;
use App\Models\User;

class Booking_selected extends Model
{
    protected $table = 'booking_selected'; // 👈 database name
    protected $fillable = [
        'booking_id',
        'package_id',
        'room_id',
        'user_id'
    ];

    function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'id');
    }
    function package()
    {
        return $this->belongsTo(Package::class, 'package_id', 'id');
    }
    function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }
    function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

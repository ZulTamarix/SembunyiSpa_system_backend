<?php

namespace App\Models\Booking;

use App\Models\Log\Log_booking;
use App\Models\Package\Package;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Booking extends Model
{
    protected $table = 'booking'; // 👈 database name
    protected $fillable = [
        'package_id',
        'user_id',
        'user_shared_id',
        'date_start',
        'time_start',
        'time_end',
        'user_id',
        'room_id',
        'status',
        'payment',
        'price_original',
        'price_discount',
        'price_final',
        'booking_type',
        'remark',

        'recorded_time_start',
        'recorded_time_end'
    ];
    
    function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    function user_shared()
    {
        return $this->belongsTo(User::class, 'user_shared_id', 'id');
    }
    function package()
    {
        return $this->belongsTo(Package::class, 'package_id', 'id');
    }
    public function booking_selected() // for therapist
    {
        return $this->hasMany(Booking_selected::class, 'booking_id', 'id');
    }
    public function log() // for therapist
    {
        return $this->hasMany(Log_booking::class, 'booking_id', 'id');
    }
}

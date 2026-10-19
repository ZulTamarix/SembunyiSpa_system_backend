<?php

namespace App\Models\Roster;

use Illuminate\Database\Eloquent\Model;
use App\Models\Booking\Booking_selected;
use App\Models\Roster\Roster_leave;
use App\Models\Roster\Roster_shift;
use App\Models\User;
use App\Models\Room;

class Roster extends Model
{
    protected $table = 'roster'; // 👈 database name
    protected $fillable = [
        'date',
        'user_id',
        'roster_leave_id',
        'roster_shift_id'
    ];
    
    function booking_selected()
    {
        return $this->hasMany(Booking_selected::class, 'user_id', 'user_id');
    }
    public function leave()
    {
        return $this->belongsTo(Roster_leave::class, 'roster_leave_id', 'id');
    }
    public function shift()
    {
        return $this->belongsTo(Roster_shift::class, 'roster_shift_id', 'id');
    }
    public function adjustment()
    {
        return $this->hasMany(Roster_adjustment::class, 'roster_id', 'id');
    }

    // for availability
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }
}

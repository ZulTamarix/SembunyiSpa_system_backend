<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Booking\Booking_selected;

class Room extends Model
{
    protected $table = 'room'; // 👈 database name
    protected $fillable = [
        'name',
        'description'
    ];

    public function booking_selected()
    {
        return $this->hasMany(Booking_selected::class, 'user_id', 'id');
    }

    // 👇 Always sort by 'name' asc order 'GLOBALLY'
    protected static function booted()
    {
        static::addGlobalScope('ordered', function ($query) {
            $query->orderBy('name', 'asc');
        });
    }
}

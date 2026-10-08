<?php

namespace App\Models\Package;

use Illuminate\Database\Eloquent\Model;
use App\Models\Room;

class Package_room extends Model
{
    protected $table = 'package_room'; // 👈 database name
    protected $fillable = [
        'package_id',
        'room_id'
    ];
    
    public function room()
    {
        return $this->hasOne(Room::class, 'id', 'room_id');
    } 
}

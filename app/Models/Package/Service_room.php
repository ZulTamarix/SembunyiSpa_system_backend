<?php

namespace App\Models\Package;

use Illuminate\Database\Eloquent\Model;

class Service_room extends Model
{
    protected $table = 'service_room'; // 👈 database name
    protected $fillable = [
        'service_id',
        'room_id'
    ];
}

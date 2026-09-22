<?php

namespace App\Models\Package;

use Illuminate\Database\Eloquent\Model;
use App\Models\Package\Package;

class Package_room extends Model
{
    protected $table = 'package_room'; // 👈 database name
    protected $fillable = [
        'package_id',
        'room_id'
    ];
    
    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id', 'id');
    }
}

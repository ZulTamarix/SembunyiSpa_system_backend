<?php

namespace App\Models\Package;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use App\Models\Package\Package;

class Package_room extends Model
{
    use HasUuids;
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

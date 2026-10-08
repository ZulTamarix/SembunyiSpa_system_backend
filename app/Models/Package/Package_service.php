<?php

namespace App\Models\Package;

use Illuminate\Database\Eloquent\Model;

class Package_service extends Model
{
    protected $table = 'package_service'; // 👈 database name
    protected $fillable = [
        'package_id',
        'service_id'
    ];

    public function service()
    {
        return $this->hasOne(Package::class, 'id', 'service_id');
    }
    public function room()
    {
        return $this->hasMany(Package_room::class, 'package_id', 'service_id');
    }
    public function therapist()
    {
        return $this->hasMany(Package_therapist::class, 'package_id', 'service_id');
    }
}
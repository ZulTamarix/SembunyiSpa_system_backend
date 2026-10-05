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
}

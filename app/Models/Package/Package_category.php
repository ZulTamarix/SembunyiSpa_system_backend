<?php

namespace App\Models\Package;

use Illuminate\Database\Eloquent\Model;

class Package_category extends Model
{
    protected $table = 'package_category'; // 👈 database name
    protected $fillable = [
        'name'
    ];
}

<?php

namespace App\Models\Package;

use Illuminate\Database\Eloquent\Model;

class Service_category extends Model
{
    protected $table = 'service_category'; // 👈 database name
    protected $fillable = [
        'name'
    ];
}

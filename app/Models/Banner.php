<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banner'; // 👈 database name
    protected $fillable = [
        'poster',
        'title',
        'description',
        'status',
        'date_expired'
    ];
}

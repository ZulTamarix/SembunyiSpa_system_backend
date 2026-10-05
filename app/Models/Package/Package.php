<?php

namespace App\Models\Package;

use Illuminate\Database\Eloquent\Model;
class Package extends Model
{
    protected $table = 'package'; // 👈 database name
    protected $fillable = [
        'poster',
        'title',
        'description',
        'duration',
        'price',
        'gender',
        'detail'
    ];
}

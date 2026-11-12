<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_token extends Model
{
    protected $table = 'user_token'; // 👈 database name
    protected $fillable = [
        'user_id',
        'token'
    ];
}

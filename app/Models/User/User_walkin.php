<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class User_walkin extends Model
{
    protected $table = 'user_walkin'; // 👈 database name
    protected $fillable = [
        'name',
        'phoneNo',
        'email',
        'date_joined',
        'total_booking',
        'status'
    ];
}

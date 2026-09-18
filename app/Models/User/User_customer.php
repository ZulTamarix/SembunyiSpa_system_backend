<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class User_customer extends Model
{
    use HasUuids;

    // protected $connection = 'enter connection';
    protected $table = 'user_customer'; // 👈 database name

    protected $fillable = [
        'user_id',
        'membership_id',
        'membership_code',
        'total_booking',
        'date_joined'
    ];
}

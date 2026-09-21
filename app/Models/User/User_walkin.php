<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class User_walkin extends Model
{
    use HasUuids;
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

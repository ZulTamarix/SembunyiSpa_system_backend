<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class User_therapist extends Model
{
    use HasUuids;

    // protected $connection = 'enter connection';
    protected $table = 'user_therapist'; // 👈 database name

    protected $fillable = [
        'user_id',
        'position',
        'code',
    ];
}

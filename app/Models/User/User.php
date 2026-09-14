<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasUuids;

    protected $connection = 'enter connection';
    protected $table = 'user'; // 👈 database name

    protected $fillable = [
        'role',
        'name',
        'email',
        'phoneNo',
        'status'
    ];


    public function user_group()
    {
        return $this->hasOne(User_group::class, 'id', 'user_group_id');
    }
}

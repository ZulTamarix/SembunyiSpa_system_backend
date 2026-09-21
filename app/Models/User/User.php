<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasUuids;

    // protected $connection = 'enter connection';
    protected $table = 'user'; // 👈 database name

    protected $fillable = [
        'role',
        'name',
        'email',
        'phoneNo',
        'password',
        'status'
    ];

    public function therapist()
    {
        return $this->hasOne(User_therapist::class, 'user_id', 'id');
    }
    public function customer()
    {
        return $this->hasOne(User_customer::class, 'user_id', 'id');
    }
}

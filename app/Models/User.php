<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Membership\Membership;

class User extends Model
{
    protected $table = 'user'; // 👈 database name
    protected $fillable = [
        'role',
        'name',
        'email',
        'phoneNo',
        'password',
        'status',
        'date_joined',
        'membership_id',
        'specialty',
        'code'
    ];

    function membership()
    {
        return $this->belongsTo(Membership::class, 'membership_id', 'id');
    }
    // 👇 Sort 'role' in asc order 'GLOBALLY'
    protected static function booted()
    {
        static::addGlobalScope('ordered', function ($query) {
            $query->orderBy('role', 'asc');
        });
    }
}

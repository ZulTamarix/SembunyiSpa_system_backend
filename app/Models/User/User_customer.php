<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class User_customer extends Model
{
    protected $table = 'user_customer'; // 👈 database name
    protected $fillable = [
        'user_id',
        'membership_id',
        'membership_code',
        'total_booking',
        'date_joined'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

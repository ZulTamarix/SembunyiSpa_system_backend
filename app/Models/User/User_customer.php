<?php

namespace App\Models\User;

use App\Models\Membership\Membership_customer;
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
    public function membership_customer()
    {
        return $this->hasOne(Membership_customer::class, 'user_customer_id', 'id');
    }
}

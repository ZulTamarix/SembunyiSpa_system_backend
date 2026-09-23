<?php

namespace App\Models\Membership;

use App\Models\User\User_customer;
use App\Models\Membership\Membership;

use Illuminate\Database\Eloquent\Model;

class Membership_customer extends Model
{
    protected $table = 'membership_customer'; // 👈 database name
    protected $fillable = [
        'user_customer_id',
        'membership_id',
        'code',
        'date_joined'
    ];
    
    public function membership()
    {
        return $this->belongsTo(Membership::class, 'membership_id', 'id');
    }
    public function user_customer()
    {
        return $this->belongsTo(User_customer::class, 'user_customer_id', 'id');
    }
}

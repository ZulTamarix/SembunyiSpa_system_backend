<?php

namespace App\Models\Membership;

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
}

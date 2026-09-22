<?php

namespace App\Models\Membership;

use Illuminate\Database\Eloquent\Model;
use App\Models\Membership\Membership_privilege;
use App\Models\Membership\Membership_customer;

class Membership extends Model
{
    protected $table = 'membership'; // 👈 database name
    protected $fillable = [
        'tier'
    ];
    
    public function privilege()
    {
        return $this->hasMany(Membership_privilege::class, 'membership_id', 'id');
    }
    public function customer()
    {
        return $this->hasMany(Membership_customer::class, 'membership_id', 'id');
    }
}

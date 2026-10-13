<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Membership;
use App\Models\Voucher\Voucher_customer;
use App\Models\Booking\Booking_selected;

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
        'membership_date_expired',
        'specialty',
        'code'
    ];

    function membership()
    {
        return $this->belongsTo(Membership::class, 'membership_id', 'id');
    }
    public function voucherCustomers()
    {
        return $this->hasMany(Voucher_customer::class, 'user_id', 'id');
    }
    public function booking_selected()
    {
        return $this->hasMany(Booking_selected::class, 'user_id', 'id');
    }


    // 👇 Sort 'role' in asc order 'GLOBALLY'
    protected static function booted()
    {
        static::addGlobalScope('ordered', function ($query) {
            $query->orderBy('role', 'asc');
        });
    }
}

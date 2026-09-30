<?php

namespace App\Models\Voucher;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $table = 'voucher'; // 👈 database name
    protected $fillable = [
        'code',
        'description',
        'type',
        'date_expired',
        'status',
        'discount_type',
        'discount_value',
        'quantity',
    ];

    // 👇 Sort 'date_expired' in asc order 'GLOBALLY'
    protected static function booted()
    {
        static::addGlobalScope('ordered', function ($query) {
            $query->orderBy('date_expired', 'asc');
        });
    }
}

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
}

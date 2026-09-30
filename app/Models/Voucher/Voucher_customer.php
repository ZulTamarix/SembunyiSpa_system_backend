<?php

namespace App\Models\Voucher;

use Illuminate\Database\Eloquent\Model;

class Voucher_customer extends Model
{
    protected $table = 'voucher_customer'; // 👈 database name
    protected $fillable = [
        'voucher_id',
        'user_id',
        'quantity'
    ];
}

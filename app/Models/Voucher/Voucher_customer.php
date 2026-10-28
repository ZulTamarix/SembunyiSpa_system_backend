<?php

namespace App\Models\Voucher;

use Illuminate\Database\Eloquent\Model;
use App\Models\Log\Log_voucher;

class Voucher_customer extends Model
{
    protected $table = 'voucher_customer'; // 👈 database name
    protected $fillable = [
        'voucher_id',
        'user_id',
        'quantity',
        'date_expired',
        'serial_no'
    ];

    function voucher()
    {
        return $this->belongsTo(Voucher::class, 'voucher_id', 'id');
    }
    function log()
    {
        return $this->hasMany(Log_voucher::class, 'voucher_customer_id', 'id');

    }
}

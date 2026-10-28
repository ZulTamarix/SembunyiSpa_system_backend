<?php

namespace App\Models\Log;

use Illuminate\Database\Eloquent\Model;

class Log_voucher extends Model
{
    protected $table = 'log_voucher'; // 👈 database name
    protected $fillable = [
        'voucher_customer_id',
        'action'
    ];
}

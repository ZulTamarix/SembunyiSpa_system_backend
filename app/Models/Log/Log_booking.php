<?php

namespace App\Models\Log;

use Illuminate\Database\Eloquent\Model;

class Log_booking extends Model
{
    protected $table = 'log_booking'; // 👈 database name
    protected $fillable = [
        'booking_id',
        'action'
    ];
}

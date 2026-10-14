<?php

namespace App\Models\Roster;

use Illuminate\Database\Eloquent\Model;

class Roster_adjustment extends Model
{
    protected $table = 'roster_adjustment'; // 👈 database name
    protected $fillable = [
        'roster_id',
        'type',
        'time_start',
        'time_end',
        'reason'
    ];
}
<?php

namespace App\Models\Roster;

use Illuminate\Database\Eloquent\Model;
use App\Models\Roster\Roster;

class Roster_shift extends Model
{
    protected $table = 'roster_shift'; // 👈 database name
    protected $fillable = [
        'icon',
        'time_start',
        'time_end'
    ];

    public function roster()
    {
        return $this->hasMany(Roster::class, 'roster_shift_id', 'id');
    }

    // 👇 Sort 'icon' in asc order 'GLOBALLY'
    protected static function booted()
    {
        static::addGlobalScope('ordered', function ($query) {
            $query->orderBy('icon', 'asc');
        });
    }
}

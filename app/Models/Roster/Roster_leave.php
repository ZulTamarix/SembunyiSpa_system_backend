<?php

namespace App\Models\Roster;

use Illuminate\Database\Eloquent\Model;
use App\Models\Roster\Roster;

class Roster_leave extends Model
{
    protected $table = 'roster_leave'; // 👈 database name
    protected $fillable = [
        'icon',
        'description'
    ];

    public function roster()
    {
        return $this->hasMany(Roster::class, 'roster_leave_id', 'id');
    }

    // 👇 Sort 'icon' in asc order 'GLOBALLY'
    protected static function booted()
    {
        static::addGlobalScope('ordered', function ($query) {
            $query->orderBy('icon', 'asc');
        });
    }
}

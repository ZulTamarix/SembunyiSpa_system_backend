<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasUuids;
    protected $table = 'room'; // 👈 database name

    protected $fillable = [
        'name',
        'description'
    ];


    // 👇 Always sort by 'name' asc order 'GLOBALLY'
    protected static function booted()
    {
        static::addGlobalScope('ordered', function ($query) {
            $query->orderBy('name', 'asc');
        });
    }
}

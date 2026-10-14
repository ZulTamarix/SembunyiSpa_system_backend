<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notification'; // 👈 database name
    protected $fillable = [
        'user_id',
        'type',
        'title',
        'description'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    } 
}

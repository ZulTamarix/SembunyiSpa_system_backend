<?php

namespace App\Models\Notification;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Notification extends Model
{
    protected $table = 'notification'; // 👈 database name
    protected $fillable = [
        'role',
        'title',
        'description'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    } 
}

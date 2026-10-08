<?php

namespace App\Models\Package;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Package_therapist extends Model
{
    protected $table = 'package_therapist'; // 👈 database name
    protected $fillable = [
        'package_id',
        'user_id'
    ];
    
    public function therapist()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    } 
}

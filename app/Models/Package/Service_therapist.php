<?php

namespace App\Models\Package;

use Illuminate\Database\Eloquent\Model;

class Service_therapist extends Model
{
    protected $table = 'service_therapist'; // 👈 database name
    protected $fillable = [
        'service_id',
        'user_id'
    ];
}

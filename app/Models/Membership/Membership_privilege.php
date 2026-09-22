<?php

namespace App\Models\Membership;

use Illuminate\Database\Eloquent\Model;
use App\Models\Membership\Membership;

class Membership_privilege extends Model
{
    protected $table = 'membership_privilege'; // 👈 database name
    protected $fillable = [
        'membership_id',
        'list'
    ];
    
    public function membership()
    {
        return $this->belongsTo(Membership::class, 'membership_id', 'id');
    }
}

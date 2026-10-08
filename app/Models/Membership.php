<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Voucher\Voucher;

class Membership extends Model
{
    protected $table = 'membership'; // 👈 database name
    protected $fillable = [
        'tier'
    ];
    
    public function voucher()
    {
        return $this->hasMany(Voucher::class, 'membership_id', 'id');
    } 
}

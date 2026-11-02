<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Voucher\Voucher;

class Membership extends Model
{
    protected $table = 'membership'; // 👈 database name
    protected $fillable = [
        'tier',
        'serial_code',
        'duration'
    ];
    
    public function voucher()
    {
        return $this->hasMany(Voucher::class, 'membership_id', 'id');
    } 
    public function Customer()
    {
        return $this->belongsTo(Voucher::class, 'membership_id', 'id');
    } 
}

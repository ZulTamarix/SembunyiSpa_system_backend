<?php

namespace App\Models\Package;

use Illuminate\Database\Eloquent\Model;
use App\Models\Package\Package;

class Package_detail extends Model
{
    protected $table = 'package_detail'; // 👈 database name
    protected $fillable = [
        'package_id',
        'detail'
    ];
    
    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id', 'id');
    }
}

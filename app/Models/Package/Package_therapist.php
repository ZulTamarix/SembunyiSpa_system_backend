<?php

namespace App\Models\Package;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use App\Models\Package\Package;

class Package_therapist extends Model
{
    use HasUuids;
    protected $table = 'package_therapist'; // 👈 database name

    protected $fillable = [
        'package_id',
        'user_therapist_id'
    ];
    
    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id', 'id');
    }
}

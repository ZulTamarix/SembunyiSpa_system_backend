<?php

namespace App\Models\Package;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use App\Models\Package\Package_detail;
use App\Models\Package\Package_therapist;
use App\Models\Package\Package_room;

class Package extends Model
{
    use HasUuids;
    protected $table = 'package'; // 👈 database name

    protected $fillable = [
        'poster',
        'title',
        'type',
        'description',
        'duration',
        'price',
        'gender'
    ];
    
    public function detail()
    {
        return $this->hasMany(Package_detail::class, 'package_id', 'id');
    }
    public function therapist()
    {
        return $this->hasMany(Package_therapist::class, 'package_id', 'id');
    }
    public function room()
    {
        return $this->hasMany(Package_room::class, 'package_id', 'id');
    }
}

<?php

namespace App\Models\Package;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Package extends Model
{
    protected $table = 'package'; // 👈 database name
    protected $fillable = [
        'poster',
        'title',
        'description',
        'duration',
        'price',
        'gender',
        'type',
        'detail',
        
        'package_category_id',
        'is_standalone'
    ];

    public function package_category()
    {
        return $this->hasOne(Package_category::class, 'id', 'package_category_id');
    }
    public function package_service()
    {
        return $this->hasMany(Package_service::class, 'package_id', 'id');
    }
    public function package_room()
    {
        return $this->hasMany(Package_room::class, 'package_id', 'id');
    }
    public function package_therapist()
    {
        return $this->hasMany(Package_therapist::class, 'package_id', 'id');
    }

    // change to bullet point
    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => preg_split('/\r\n|\r|\n/', $value, -1, PREG_SPLIT_NO_EMPTY)
        );
    }
    protected function detail(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => preg_split('/\r\n|\r|\n/', $value, -1, PREG_SPLIT_NO_EMPTY)
        );
    }
}
    
<?php

namespace App\Models\Package;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'service'; // 👈 database name
    protected $fillable = [
        'poster',
        'title',
        'description',
        'duration',
        'price',
        'gender',
        'detail',
        
        'package_category_id',
        'is_standalone'
    ];

    public function category()
    {
        return $this->hasOne(Package_category::class, 'id', 'package_category_id');
    }

}

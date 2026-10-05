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
        
        'service_category_id',
        'is_standalone'
    ];

    public function category()
    {
        return $this->hasOne(Service_category::class, 'id', 'service_category_id');
    }

}

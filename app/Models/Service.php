<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{

    public function shops()
    {
        return $this->belongsToMany(
            Shop::class,
            'shop_services',
            'services_id',
            'shop_id'
        );
    }

    public function metas()
    {
        return $this->hasMany(ServiceMeta::class, 'services_id');
    }

    public function serviceMetas()
    {
        return $this->hasMany(ServiceMeta::class, 'services_id', 'id');
    }
}

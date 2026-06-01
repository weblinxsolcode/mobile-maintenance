<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class shop extends Model
{
    protected $table = 'shops';

    protected $fillable = [
        'username',
        'email',
        'phone_number',
        'password',
        'title',
        'address',
        'latitude',
        'longitude',
        'description',
        'profile',
    ];

    public function reviews()
    {
        return $this->hasMany(Reviews::class, 'shop_id');
    }

    public function shopReviews()
    {
        return $this->hasMany(Reviews::class, 'shop_id', 'id');
    }

    public function services()
    {
        return $this->belongsToMany(
            Service::class,
            'shop_services',
            'shop_id',
            'services_id'
        );
    }
}

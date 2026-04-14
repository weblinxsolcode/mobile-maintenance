<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class shop extends Model
{

    protected $table = 'shops';

    protected $fillable = [
        'username',
        'email',
        'password',
        'title',
        'address',
        'latitude',
        'longitude',
        'description',
        'profile'
    ];


}

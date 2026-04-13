<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Technicians extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'password',
        'phone_number',
        'profile_picture',
        'registration_type',
        'status',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable = [
        'google_api_key',
        'near_by_location',
        'privacy_policy',
        'terms_and_condition',
        'about_us',
    ];
}

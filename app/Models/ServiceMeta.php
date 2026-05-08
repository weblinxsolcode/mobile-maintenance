<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceMeta extends Model
{
    protected $table = 'service_metas';

    protected $fillable = [
        'services_id',
        'type',
        'value'
    ];
}

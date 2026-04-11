<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Management extends Model
{
    public function child()
    {
        return $this->hasMany(Management::class, 'parent_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Management extends Model
{
    protected $fillable = [
        'name',
        'parent_id',
        'role'
    ];

    public function child()
    {
        return $this->hasMany(Management::class, 'parent_id');
    }

    public function brand()
    {
        return $this->belongsTo(Management::class, 'parent_id');
    }
}

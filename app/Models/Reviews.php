<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    public function userInfo()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function jobInfo()
    {
        return $this->belongsTo(JobListings::class, 'job_id', 'id');
    }
}

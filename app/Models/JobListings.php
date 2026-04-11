<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobListings extends Model
{
    public function jobApplications()
    {
        return $this->hasMany(JobApplications::class, 'job_id', 'id')->with('shopInfo');
    }

    public function userInfo()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

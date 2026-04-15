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

    public function shopInfo()
    {
        return $this->belongsTo(Shop::class, 'shop_id');
    }

    public function shopInfoReviews()
    {
        return $this->belongsTo(Shop::class, 'shop_id', 'id');
    }

}

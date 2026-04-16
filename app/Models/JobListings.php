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
        return $this->belongsTo(shop::class, 'shop_id');
    }

    public function shopInfoReviews()
    {
        return $this->belongsTo(shop::class, 'shop_id', 'id');
    }
    public function shop()
    {
        return $this->belongsTo(shop::class);
    }

}

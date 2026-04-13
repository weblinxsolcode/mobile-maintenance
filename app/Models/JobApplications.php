<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplications extends Model
{
    public function jobInfo()
    {
        return $this->belongsTo(JobListings::class, 'job_id', 'id');
    }

    public function shopInfo()
    {
        return $this->belongsTo(shop::class, 'shop_id', 'id');
    }

    public function userInfo()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function technicianInfo()
    {
        return $this->belongsTo(shop::class, 'technician_id', 'id');
    }
}

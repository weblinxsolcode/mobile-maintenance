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
        return $this->belongsTo(Shop::class, 'shop_id', 'id');
    }
}

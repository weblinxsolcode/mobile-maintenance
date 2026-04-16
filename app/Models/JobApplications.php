<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplications extends Model
{
    protected $fillable = ['job_id', 'shop_id', 'user_id', 'technician_id', 'description', 'status', 'created_at', 'updated_at', 'price', 'time', 'warranty', 'warranty_months'];
    public function jobInfo()
    {
        return $this->belongsTo(JobListings::class, 'job_id', 'id');
    }

    public function shopInfo()
    {
        return $this->belongsTo(shop::class, 'shop_id', 'id')->with('reviews');
    }

    public function userInfo()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function technicianInfo()
    {
        return $this->belongsTo(Technicians::class, 'technician_id', 'id');
    }
    public function priceHistories()
{
    return $this->hasMany(price_histories::class, 'job_application_id');
}
}

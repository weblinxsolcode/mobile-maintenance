<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplications extends Model
{
    protected $fillable = ['job_id', 'shop_id', 'user_id', 'technician_id', 'description', 'status', 'created_at', 'updated_at', 'price', 'time', 'warranty', 'warranty_months', 'image', 'title', 'device_models'];

    protected $casts = [
        'device_models' => 'array',
    ];

    protected $appends = ['device_models_data'];

    public function getDeviceModelsDataAttribute()
    {
        $ids = $this->device_models ?: [];
        if (empty($ids)) {
            return collect();
        }
        return Management::whereIn('id', $ids)->with('brand')->get();
    }

    public function jobInfo()
    {
        return $this->belongsTo(JobListings::class, 'job_id', 'id');
    }

    public function service()
    {
        return $this->hasMany(service::class, 'service_id', 'id');
    }

    public function shopInfo()
    {
        return $this->belongsTo(shop::class, 'shop_id', 'id')->with('reviews');
    }

    public function priceInfo()
    {
        return $this->hasMany(price_histories::class, 'job_application_id');
    }

    // public function priceInfo()
    // {
    //     return $this->belongsTo(price_histories::class, 'job', 'id');
    // }

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

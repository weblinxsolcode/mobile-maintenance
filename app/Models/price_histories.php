<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class price_histories extends Model
{
    protected $fillable = [
        'job_application_id',
        'old_price',
        'new_price',
        'changed_by'
    ];

 


    public function changedByShop()
    {
        return $this->belongsTo(shop::class, 'changed_by');
    }
    public function jobApplication()
{
    return $this->belongsTo(JobApplications::class, 'job_application_id');
}
}

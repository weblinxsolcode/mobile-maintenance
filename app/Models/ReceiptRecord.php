<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReceiptRecord extends Model
{
    protected $table = 'receipt_records';

    protected $fillable = [
        'job_application_id',
        'receipt_type',
        'shop_name',
        'shop_phone',
        'shop_address',
        'receipt_data',
        'customer_signature',
        'technician_signature',
    ];

    protected $casts = [
        'receipt_data' => 'array',
    ];

    public function jobApplication()
    {
        return $this->belongsTo(JobApplications::class, 'job_application_id', 'id');
    }
}

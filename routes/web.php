<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (!session()->has('shop_id')) {
        return redirect()->route('shop.login');
    }

    return redirect()->route('shop.dashboard');
});

// Route For Shop
include 'shop.php';    
// Route For Shop

// Route For Technician
include 'technician.php';
// Route For Technician

// Public Customer Job Tracking Route
use App\Models\JobApplications;
use App\Models\ReceiptRecord;

Route::get('/track/{id}', function ($id) {
    $job = JobApplications::with(['jobInfo', 'userInfo', 'shopInfo', 'technicianInfo'])->find($id);
    if (!$job) {
        abort(404, 'Sorry, this maintenance job could not be found.');
    }
    
    // Fetch archived receipt snapshots for check-in and final
    $checkInReceipt = ReceiptRecord::where('job_application_id', $id)->where('receipt_type', 'check_in')->first();
    $finalReceipt = ReceiptRecord::where('job_application_id', $id)->where('receipt_type', 'final')->first();
    
    $title = "Track Repair Progress - Job #" . $id;
    return view('customer.track', compact('job', 'checkInReceipt', 'finalReceipt', 'title'));
})->name('customer.track');
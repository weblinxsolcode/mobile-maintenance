<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


Route::get('/migrate', function () {
    Artisan::call('migrate');
    return response('Database migrated successfully: ' . Artisan::output());
});

Route::get('/storage-link', function () {
    $target = storage_path('app/public');
    $link = public_path('storage');

    if (file_exists($link) || is_link($link)) {
        return response('The [public/storage] link already exists!');
    }

    if (!file_exists($target)) {
        mkdir($target, 0755, true);
    }

    try {
        if (@symlink($target, $link)) {
            return response('Storage link created successfully via native symlink!');
        }
        
        // Fallback using artisan if available
        if (function_exists('exec')) {
            Artisan::call('storage:link');
            return response('Storage link created successfully: ' . Artisan::output());
        }

        return response('Could not create symlink automatically. Target: ' . $target . ' | Link: ' . $link);
    } catch (\Throwable $e) {
        return response('Error creating storage link: ' . $e->getMessage());
    }
});

Route::get('/clear-cache', function () {
    Artisan::call('optimize:clear');
    return response('All caches cleared successfully: ' . Artisan::output());
});


Route::get('/', function () {
    if (!session()->has('shop_id')) {
        return redirect()->route('shop.login');
    }

    return redirect()->route('shop.dashboard');
});


// Route For Shop
include 'shop.php';
// Route For Shop

// Route For Admin
include 'admin.php';
// Route For Admin

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
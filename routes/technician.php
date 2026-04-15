<?php

use App\Http\Middleware\TechnicianAuth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TechnicianController;

// Route For Technician Prefix
Route::prefix('technician')->group(function () {

    // Technician Login
    Route::get('/login', [TechnicianController::class, 'showLogin'])->name('technician.login');

    // Technician Login Check
    Route::post('/login', [TechnicianController::class, 'loginCheck'])->name('technician.loginCheck');

    // Technician Logout
    Route::get('/logout', [TechnicianController::class, 'logout'])->name('technician.logout');



    // Technician Auth Middelware
    Route::middleware(TechnicianAuth::class)->group(function () {

        // Route::get('/dashboard', [TechnicianController::class, 'dashboard'])->name('technician.dashboard');

        // Assigned Jobs
        Route::prefix('assigned-jobs')->group(function () {

            // Assigned Jobs List
            Route::get('/list', [TechnicianController::class, 'assignedJobs'])->name('technician.assignedJobs.index');

            // Assign Jobs Update Status
            Route::put('/{id}/status', [TechnicianController::class, 'updateStatus'])->name('technician.assignedJobs.updateStatus');
        });

        // Technician Profile
        Route::get('/profile', [TechnicianController::class, 'profile'])->name('technician.profile');

        // Technician Profile Update
        Route::post('/profile/update/{id}', [TechnicianController::class, 'profileUpdate'])->name('technician.profile.update');
    });
});
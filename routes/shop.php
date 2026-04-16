<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Middleware\ShopAuth;

// Route For Shop Prefix
Route::prefix('shop')->group(function () {

    // Shop Login
    Route::get('/login', [ShopController::class, 'showLogin'])->name('shop.login');

    // Shop Login Check
    Route::post('/login', [ShopController::class, 'loginCheck'])->name('shop.loginCheck');

    // Shop Logout
    Route::get('/logout', [ShopController::class, 'logout'])->name('shop.logout');

    // Shop Auth Middelware
    Route::middleware(ShopAuth::class)->group(function () {

        Route::get('/dashboard', [ShopController::class, 'dashboard'])->name('shop.dashboard');

        // Applied Jobs
        Route::prefix('jobs-offers')->group(function () {

            // Applied Jobs List
            Route::get('/list', [ShopController::class, 'appliedJobs'])->name('shop.appliedJobs.index');

            // Applied Jobs Details
            Route::get('/details/{id}', [ShopController::class, 'appliedJobsDetails'])->name('shop.appliedJobs.details');

            // Applied Job Status
            Route::post('/status/{id}', [ShopController::class, 'appliedJobsStatus'])->name('shop.appliedJobs.status');

            // Applied Job Delete
            Route::get('/delete/{id}', [ShopController::class, 'appliedJobsDelete'])->name('shop.appliedJobs.delete');

            // Submit Offer
            Route::post('/submit-offer/{id}', [ShopController::class, 'submitOffer'])->name('shop.appliedJobs.submitOffer');

            // Submit Offer Update
            Route::put('/submit-offer-update/{id}', [ShopController::class, 'submitOfferUpdate'])->name('shop.appliedJobs.submitOfferUpdate');

        });
        // Orders Jobs
        Route::prefix('orders')->group(function () {

            // Orders List
            Route::get('/list', [ShopController::class, 'orders'])->name('shop.orders.index');

            // Orders Details
            Route::get('/details/{id}', [ShopController::class, 'ordersDetails'])->name('shop.orders.details');

            // Orders Status
            Route::post('/status/{id}', [ShopController::class, 'ordersStatus'])->name('shop.orders.status');

            // Orders Delete
            Route::get('/delete/{id}', [ShopController::class, 'ordersDelete'])->name('shop.orders.delete');

        });

        // Assigned Jobs
        Route::prefix('assigned-jobs')->group(function () {

            // Assigned Jobs List
            Route::get('/list', [ShopController::class, 'assignedJobs'])->name('shop.assignedJobs.index');

            // Assigned Jobs Details
            Route::get('/details/{id}', [ShopController::class, 'assignedJobsDetails'])->name('shop.assignedJobs.details');

            // Assigned Jobs to Technicians
            Route::get('/assign/{id}', [ShopController::class, 'assignedJobsCreate'])->name('shop.assignedJobs.assignTechnician');

            // Assigned Jobs to Technicians Store
            Route::post('/assign/{id}', [ShopController::class, 'assignedJobsStore'])->name('shop.assignedJobs.assignTechnician.store');

            Route::get('assigned-jobs/{id}/reassign', [ShopController::class, 'reassignForm'])->name('shop.assignedJobs.reassign');

            Route::put('assigned-jobs/{id}/reassign', [ShopController::class, 'reassignUpdate'])->name('shop.assignedJobs.reassign.update');

            Route::delete('assigned-jobs/{id}/remove-technician', [ShopController::class, 'removeTechnician'])->name('shop.assignedJobs.removeTechnician');

            Route::post('/assigned-jobs/{id}/update-status', [ShopController::class, 'updateStatus'])->name('shop.assignedJobs.updateStatus');
        });

        // Technicians
        Route::prefix('technicians')->group(function () {

            // Technicians List
            Route::get('/list', [ShopController::class, 'technicians'])->name('shop.technicians.index');

            // Technicians Create
            Route::get('/create', [ShopController::class, 'techniciansCreate'])->name('shop.technicians.create');

            // Technicians Store
            Route::post('/store', [ShopController::class, 'techniciansStore'])->name('shop.technicians.store');

            // Technicians Edit
            Route::get('/edit/{id}', [ShopController::class, 'techniciansEdit'])->name('shop.technicians.edit');

            // Technicians Update
            Route::post('/update/{id}', [ShopController::class, 'techniciansUpdate'])->name('shop.technicians.update');

            // Technicians Delete
            Route::get('/delete/{id}', [ShopController::class, 'techniciansDelete'])->name('shop.technicians.delete');


        });

        // Review Prefix
        Route::prefix('reviews')->group(function () {

            // Review List
            Route::get('/list', [ShopController::class, 'reviews'])->name('shop.reviews.index');

            // Review Delete
            Route::get('/delete/{id}', [ShopController::class, 'reviewsDelete'])->name('shop.reviews.delete');

        });

        // Profile
        Route::get('/profile', [ShopController::class, 'profile'])->name('shop.profile');

        // Profile Update
        Route::post('/profile-update/{id}', [ShopController::class, 'profileUpdate'])->name('shop.profile.update');
    });
});
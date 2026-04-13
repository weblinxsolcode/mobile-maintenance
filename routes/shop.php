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

        });
        // Applied Jobs
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
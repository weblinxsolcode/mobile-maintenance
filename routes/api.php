<?php

use App\Http\Controllers\ApiController\AuthController;
use App\Http\Controllers\ApiController\NotificationController;
use App\Http\Controllers\ApiController\ShopController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ManagementController;
use App\Models\Management;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// API For User Authentication and Profile Management
Route::post('/sign-up', [AuthController::class, 'register']);
Route::post('/verify', [AuthController::class, 'verifyOtp']);
Route::post('/login', [AuthController::class, 'UserLogin']);
Route::post('/forget', [AuthController::class, 'forgetPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);
Route::post('/update-password', [AuthController::class, 'updatePassword']);

Route::delete('/account-delete/{id}', [AuthController::class, 'accountDelete']);
Route::post('/update-profile', [AuthController::class, 'updateProfile']);
Route::post('/get-user', [AuthController::class, 'getUserProfile']);
Route::post('/social-login', [AuthController::class, 'socialUser']);

// API For User Admin Shop
Route::post('/create-shop', [ShopController::class, 'createShop']);
Route::post('get-shop', [ShopController::class, 'getShop']);
Route::get('get-all-shop', [ShopController::class, 'getAllShop']);
Route::post('get-near-by-shop', [ShopController::class, 'getNearByShops']);

// API For Get Management
Route::post('/get-management', [ManagementController::class, 'getManagement']);

// API For Get Settings
Route::get('/get-settings', [ManagementController::class, 'getSettings']);

// Job Management
Route::prefix('job')->group(function () {

    // Create Job
    Route::post('/create', [JobController::class, 'createJob']);

    // Get Job Details
    Route::post('/get-details', [JobController::class, 'getJobDetails']);

    // Accept Offer
    Route::post('/accept-offer', [JobController::class, 'acceptOffer']);

    // Searching Job
    Route::post('/searching-job', [JobController::class, 'searchingJob']);

    // Store Review
    Route::post('/store-review', [JobController::class, 'storeReview']);
});

// API for Get Reviews
Route::post('/get-reviews', [JobController::class, 'getReviews']);

// Notifications
Route::prefix('notifications')->group(function () {
    Route::post('/get', [NotificationController::class, 'getNotifications']);
    Route::post('/mark-as-read', [NotificationController::class, 'markAsRead']);
});

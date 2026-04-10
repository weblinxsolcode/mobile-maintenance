<?php

use App\Http\Controllers\ApiController\AuthController;
use App\Http\Controllers\ApiController\ShopController;
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

Route::delete('/account-delete/{id}',[AuthController::class, 'accountDelete']);
Route::post('/update-profile', [AuthController::class, 'updateProfile']);
Route::post('/get-user', [AuthController::class, 'getUserProfile']);
Route::post('/social-login', [AuthController::class, 'socialUser']);

// API For User Admin Shop 
Route::post('/create-shop',[ShopController::class, 'createShop']);
Route::post('get-shop',[ShopController::class, 'getShop']);
Route::get('get-all-shop',[ShopController::class, 'getAllShop']);
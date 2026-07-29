<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminAuth;

Route::prefix('admin')->group(function () {

    // Admin Login
    Route::get('/login', [AdminController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'loginCheck'])->name('admin.loginCheck');

    // Admin Logout
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    // Protected Admin Routes
    Route::middleware(AdminAuth::class)->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        // Shops CRUD
        Route::prefix('shops')->group(function () {
            Route::get('/list', [AdminController::class, 'shops'])->name('admin.shops.index');
            Route::get('/create', [AdminController::class, 'shopsCreate'])->name('admin.shops.create');
            Route::post('/store', [AdminController::class, 'shopsStore'])->name('admin.shops.store');
            Route::get('/edit/{id}', [AdminController::class, 'shopsEdit'])->name('admin.shops.edit');
            Route::post('/update/{id}', [AdminController::class, 'shopsUpdate'])->name('admin.shops.update');
            Route::get('/delete/{id}', [AdminController::class, 'shopsDelete'])->name('admin.shops.delete');
            Route::get('/toggle-status/{id}', [AdminController::class, 'shopsToggleStatus'])->name('admin.shops.toggleStatus');
        });

        // Profile
        Route::get('/profile', [AdminController::class, 'settings'])->name('admin.profile');
        Route::post('/profile', [AdminController::class, 'updateSettings'])->name('admin.profile.update');

        // App Settings
        Route::get('/app-settings', [AdminController::class, 'appSettings'])->name('admin.app_settings');
        Route::post('/app-settings', [AdminController::class, 'updateAppSettings'])->name('admin.app_settings.update');

    });
});

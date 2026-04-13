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
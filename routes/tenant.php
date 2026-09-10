<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function ($tenant) {
    return 'Dashboard Tenant: '.e($tenant);
})->name('dashboard');

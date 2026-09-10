<?php

use Illuminate\Support\Facades\Route;

// Landing Page Utama (Cegah error 404 pada ExampleTest & root URL)
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Dashboard default untuk alur redirect bawaan Fortify/Breeze
Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->name('dashboard');

// Route Publik Pelanggan
Route::prefix('kantin/{canteen:slug}')
    ->name('customer.')
    ->group(base_path('routes/customer.php'));

// Route Internal Tenant & Admin (Perlu Autentikasi)
Route::middleware(['auth', 'verified'])->group(function (): void {
    Route::prefix('tenant/{tenant:slug}')
        ->scopeBindings()
        ->name('tenant.')
        ->group(base_path('routes/tenant.php'));

    Route::prefix('admin')
        ->name('admin.')
        ->group(base_path('routes/admin.php'));
});
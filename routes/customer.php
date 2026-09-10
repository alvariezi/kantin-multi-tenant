<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function ($canteen) {
    return 'Katalog Kantin: '.e($canteen);
})->name('home');

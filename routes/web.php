<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('/about-us', [\App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/contact-us', [\App\Http\Controllers\HomeController::class, 'about'])->name('contact');

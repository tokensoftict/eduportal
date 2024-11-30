<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Middleware\RedirectIfNotAuthenticated;

Route::prefix('student')->namespace('App\Http\Controllers\Student')->group(function() {
    Volt::route('/', 'student.pages.auth.login')->name('student.index');
    Volt::route('login', 'student.pages.auth.login')->name('student.login');
    Volt::route('register', 'student.pages.auth.register')->name('student.register');
    Volt::route('forgot-password', 'student.pages.auth.forgot-password')->name('student.password.request');
    Volt::route('reset-password/{token}', 'student.pages.auth.reset-password')->name('password.reset');
    Route::get('logout', ['as' => 'student.logout', 'uses' => 'App\Http\Controllers\Student\Auth\LoginController@logout']);

    Route::middleware([\App\Http\Middleware\AutoLoginUserWhenVerifyingEmailAddress::class, "App\Http\Middleware\RedirectIfNotAuthenticated:student"])->group(function () {
        Volt::route('verify-email', 'student.pages.auth.verify-email')->name('student.verification.notice');
    });

    Route::middleware(["App\Http\Middleware\RedirectIfNotAuthenticated:student"])->group(function () {
        Route::get('verify-email/{id}/{hash}', ['as' => 'student.verification.verify', 'uses' => 'App\Http\Controllers\Student\Auth\VerifyEmailController'])->middleware(['signed', 'throttle:6,1']);
        Volt::route('confirm-password', 'pages.auth.confirm-password')->name('student.password.confirm');
    });

    //'verified'
    Route::middleware(["App\Http\Middleware\RedirectIfNotAuthenticated:student"])->group(function(){
        Volt::route('/dashboard', 'student.pages.dashboard')->name('student.dashboard');
        Route::get('download-receipt/{transaction}', ['as' => 'student.download.application_receipt', 'uses' => 'DownloadController@downloadApplicationReceipt']);
        Route::get('download-app-form/{student}', ['as' => 'student.download.application_app_form', 'uses' => 'DownloadController@downloadApplicationForm']);
    });
});

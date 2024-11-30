<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::prefix('portal')->group(function() {

    Route::get('/', ['as' => 'portal.index', 'uses' => 'App\Livewire\Portal\Auth\LoginComponent']);

    Route::get('/login', ['as' => 'portal.login', 'uses' => 'App\Livewire\Portal\Auth\LoginComponent']);
    Route::post('/loginprocess', ['as' => 'portal.loginprocess', 'uses' => 'App\Http\Controllers\Portal\Auth\LoginController@loginprocess']);
    Route::post('/logout', ['as' => 'portal.logout', 'uses' => 'App\Http\Controllers\Portal\Auth\LoginController@logout']);


    Route::middleware([\App\Http\Middleware\RedirectIfNotAuthenticated::class])->group(function () {
        Volt::route('/dashboard', 'portal.pages.dashboard')->name('portal.dashboard');
    });

});

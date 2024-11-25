<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::prefix('admin')->group(function() {

    Route::get('/', ['as' => 'admin.index', 'uses' => 'App\Livewire\Admin\Auth\LoginComponent']);

    Route::get('/login', ['as' => 'admin.login', 'uses' => 'App\Livewire\Admin\Auth\LoginComponent']);
    Route::post('/loginprocess', ['as' => 'admin.loginprocess', 'uses' => 'App\Http\Controllers\Admin\Auth\LoginController@loginprocess']);
    Route::post('/logout', ['as' => 'admin.logout', 'uses' => 'App\Http\Controllers\Admin\Auth\LoginController@logout']);

    Route::middleware(['auth:admin'])->group(function () {

        Volt::route('/dashboard', 'admin.pages.dashboard')->name('admin.dashboard');

        Volt::route('/settings', 'admin.pages.settings.index')->name('settings.index');

        Volt::route('/settings/religion', 'admin.pages.settings.religion.list')->name('religions.index');
        Volt::route('/settings/religion/new', 'admin.pages.settings.religion.new')->name('religions.create');
        Volt::route('/settings/religion/{id}/edit', 'admin.pages.settings.religion.new')->name('religions.edit');
        Volt::route('/settings/religion/{id}/delete', 'admin.pages.settings.religion.destroy')->name('religions.destroy');


        Volt::route('/settings/gender', 'admin.pages.settings.gender.list')->name('genders.index');
        Volt::route('/settings/gender/new', 'admin.pages.settings.gender.new')->name('genders.create');
        Volt::route('/settings/gender/{id}/edit', 'admin.pages.settings.gender.new')->name('genders.edit');
        Volt::route('/settings/gender/{id}/delete', 'admin.pages.settings.gender.destroy')->name('genders.destroy');


        Volt::route('/settings/fees', 'admin.pages.settings.fees.list')->name('fees.index');
        Volt::route('/settings/fees/new', 'admin.pages.settings.fees.new')->name('fees.create');
        Volt::route('/settings/fees/{id}/edit', 'admin.pages.settings.fees.new')->name('fees.edit');
        Volt::route('/settings/fees/{id}/delete', 'admin.pages.settings.fees.destroy')->name('fees.destroy');

        Volt::route('/settings/general_subjects', 'admin.pages.settings.general_subjects.list')->name('general_subjects.index');
        Volt::route('/settings/general_subjects/new', 'admin.pages.settings.general_subjects.new')->name('general_subjects.create');
        Volt::route('/settings/general_subjects/{id}/edit', 'admin.pages.settings.general_subjects.new')->name('general_subjects.edit');
        Volt::route('/settings/general_subjects/{id}/delete', 'admin.pages.settings.general_subjects.destroy')->name('general_subjects.destroy');

        Volt::route('/settings/document', 'admin.pages.settings.document.list')->name('document.index');
        Volt::route('/settings/document/new', 'admin.pages.settings.document.new')->name('document.create');
        Volt::route('/settings/document/{id}/edit', 'admin.pages.settings.document.new')->name('document.edit');
        Volt::route('/settings/document/{id}/delete', 'admin.pages.settings.document.destroy')->name('document.destroy');



        Volt::route('/settings/courses', 'admin.pages.settings.courses.list')->name('courses.index');
        Volt::route('/settings/courses/new', 'admin.pages.settings.courses.new')->name('courses.create');
        Volt::route('/settings/courses/{id}/edit', 'admin.pages.settings.courses.new')->name('courses.edit');
        Volt::route('/settings/courses/{id}/add_subject', 'admin.pages.settings.courses.add_subject')->name('courses.add_subject');
        Volt::route('/settings/courses/{id}/delete', 'admin.pages.settings.courses.destroy')->name('courses.destroy');


        Volt::route('/student', 'admin.pages.student.index')->name('student.index');
        Volt::route('/student/{student}/show', 'admin.pages.student.show')->name('student.show');

        Route::get('/student/{student}/admit', ['as' => 'student.admit', 'uses' => 'App\Http\Controllers\Admin\AdminDashboardController@admit_student']);
        Route::get('/student/{student}/reject', ['as' => 'student.reject', 'uses' => 'App\Http\Controllers\Admin\AdminDashboardController@reject_student']);
    });

});

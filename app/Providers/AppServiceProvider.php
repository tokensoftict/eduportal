<?php

namespace App\Providers;

use App\Classes\Settings;
use App\Events\StudentRejected;
use App\Listeners\StudentRejected as StudentRejectedListener;
use App\Events\StudentAdmitted;
use Illuminate\Support\Facades\Gate;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Settings::class, function () {
            return Settings::make(storage_path('app/settings.json'));
        });

        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Gate::define('student', function ($user) {
            if(Str::contains(request()->fullUrl(), "portal")) {
                return true;
            }
            return false;
        });

        Gate::define('admin', function ($user) {
            if(Str::contains(request()->fullUrl(), "admin")) {
                return true;
            }
            return false;
        });
    }



}

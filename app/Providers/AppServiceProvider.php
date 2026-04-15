<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force URL prefix for subfolder deployment
        \Illuminate\Support\Facades\URL::forceRootUrl(config('app.url'));

        // Share site settings with all views
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            $view->with('site', new class {
                public function __get($key) { return \App\Models\SiteSetting::get($key); }
                public function get($key, $default = null) { return \App\Models\SiteSetting::get($key, $default); }
            });
        });
    }
}

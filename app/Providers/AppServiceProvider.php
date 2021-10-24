<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \URL::forceRootUrl(\Config::get('app.url'));
        if (\Str::contains(\Config::get('app.url'), 'https://')) {
            \URL::forceScheme('https');
        }
    }
}

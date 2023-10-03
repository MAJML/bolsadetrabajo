<?php

namespace BolsaTrabajo\Providers;

use Illuminate\Support\Facades\Schema;
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
        if (\App::environment('production')) {
            \URL::forceScheme('https');
        }
        Schema::defaultStringLength(200);
        \Carbon\Carbon::setLocale('es');
        $this->app['request']->server->set('HTTPS','on');
    }
}

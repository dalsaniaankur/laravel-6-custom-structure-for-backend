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
        // Change public_html folder path..
        /*$this->app->bind('path.public', function() {
           return realpath(base_path().'/../public_html');
        });*/
        /*$this->app->bind('path.public', function() {
            return realpath(base_path().'/../public_html/dev');
        });*/
    }
}

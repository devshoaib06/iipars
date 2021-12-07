<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

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
         Validator::extend('is_url', function($attribute, $value, $parameters) {
            if (filter_var($value, FILTER_VALIDATE_URL) === FALSE) {
                return false;    
            } else {
                return true;
            }

        },'Invalid URL');

    }
}

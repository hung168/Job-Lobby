<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
        Validator::extend('malaysia_phone', function ($attribute, $value, $parameters, $validator) {
            // Use regular expression to validate the phone number format
            return preg_match('/^(\+?6?01)[0-9]{7,9}$/', $value);
        });

        Validator::replacer('malaysia_phone', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'The :attribute field is not a valid Malaysian phone number.');
        });
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class PasswordRulesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('password_rule', function ($attribute, $value, $parameters, $validator) {
            // Check if the password length is greater than 8
            if (strlen($value) < 8) {
                return false;
            }

            // Check if the password contains a special character
            if (!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $value)) {
                return false;
            }

            // Check if the password contains a capital letter
            if (!preg_match('/[A-Z]/', $value)) {
                return false;
            }

            return true;
        });

        Validator::replacer('password_rule', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'The :attribute must be at least 8 characters long, contain at least one special character, and have at least one capital letter.');
        });
    }
}

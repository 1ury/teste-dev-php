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
        \Illuminate\Support\Facades\Validator::extend('cpf_ou_cnpj', function ($attribute, $value, $parameters, $validator) {
            return (new \App\Rules\CpfOuCnpj)->passes($attribute, $value);
        });
    }
}

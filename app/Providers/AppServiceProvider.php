<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // api : 
        // 1. QFV5X2JE3E9KHNQ6NZ13
        // 2. 
        config(['api_key' => "K8HF9ER1S79W6IGGW0YP"]);
    }
}

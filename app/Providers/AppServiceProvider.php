<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Str;
use Illuminate\Support\Carbon;

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
        Str::macro('date' , function ($date) { 
            return Carbon::parse($date)->format('M d, Y');
        });
    }
}

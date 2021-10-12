<?php

namespace App\Providers;

use Illuminate\Support\Carbon;
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
        Carbon::macro('toFormattedDate', function(){
            return $this->format('Y-m-d');
        });
        Carbon::macro('toFormattedTime', function(){
            return $this->format('h:i A');
        });
    }

       

}

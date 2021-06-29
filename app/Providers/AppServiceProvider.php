<?php

namespace App\Providers;

use App\Models\Barcode;
use App\Models\Country;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
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

//        $this->app->bind(User::class , function(){
//            return Auth()->user() ;
//        });

    }
}

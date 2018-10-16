<?php

namespace App\Providers;
use DB;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);



        // menghitung item
        view()->composer('welcome',function($view)

        {

            $count_item = DB::table('master_item')->where('status','<>','99')->count();
            $view->with('count_item',$count_item);

        });

        //MENGHITUNG KUSTOMER
        view()->composer('welcome',function($view)

        {

            $count_kustomer = DB::table('master_kustomer')->count();
            $view->with('count_kustomer',$count_kustomer);

        });


        // MENGHITUNG SUPLIER
        view()->composer('welcome',function($view)

        {

            $count_suplier = DB::table('master_suplier')->count();
            $view->with('count_suplier',$count_suplier);

        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}

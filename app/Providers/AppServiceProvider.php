<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Schema;
use Route;

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
        Route::resourceVerbs([
            'create'=>'tambah',
            'edit'=>'ubah',
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

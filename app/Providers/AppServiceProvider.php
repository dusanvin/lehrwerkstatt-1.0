<?php

namespace App\Providers;

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
        
        /* Globale Variablen für alle views */

        // Mail des DigiLLab
        $mail_to_digillab = 'mailto:digillab@zlbib.uni-augsburg.de';
        View::share('mail_to_digillab', $mail_to_digillab);



        
    }
}

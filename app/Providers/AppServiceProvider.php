<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Reservacion;
use App\Observers\ReservacionObserver;

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
        // Registrar Observer para Reservacion
        Reservacion::observe(ReservacionObserver::class);
    }
}

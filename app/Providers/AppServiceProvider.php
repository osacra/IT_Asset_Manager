<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Ativo;
use App\Observers\AtivoObserver;

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
        Ativo::observe(AtivoObserver::class);
    }
}

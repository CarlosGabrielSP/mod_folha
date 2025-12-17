<?php

namespace App\Providers;

use App\Models\RelFolhaFuncionarioEvento;
use App\Observers\RelFolhaFuncionarioEventoObserver;
use Illuminate\Support\ServiceProvider;

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
        RelFolhaFuncionarioEvento::observe(RelFolhaFuncionarioEventoObserver::class);
    }
}

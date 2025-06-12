<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Repositories\PizzaTypeRepositoryInterface::class,
            \App\Repositories\PizzaTypeRepository::class
        );

        $this->app->bind(
            \App\Repositories\PizzaRepositoryInterface::class,
            \App\Repositories\PizzaRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

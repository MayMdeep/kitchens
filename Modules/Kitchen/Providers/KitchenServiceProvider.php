<?php

namespace Modules\Kitchen\Providers;

use Illuminate\Support\ServiceProvider;

class KitchenServiceProvider extends ServiceProvider
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
        $this->loadRoutesFrom(__DIR__.'/../Routes/api.php'); 
    }
}

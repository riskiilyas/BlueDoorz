<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use OpenAdmin\Admin\Config\Config;

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
        try {
            Config::load();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

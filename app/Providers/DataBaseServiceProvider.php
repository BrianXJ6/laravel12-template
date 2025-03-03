<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class DataBaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        // ...
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        DB::prohibitDestructiveCommands(app()->isProduction());
        Schema::defaultStringLength(191);
    }
}

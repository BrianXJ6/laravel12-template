<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class ModelServiceProvider extends ServiceProvider
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
        Model::shouldBeStrict();
        Model::automaticallyEagerLoadRelationships();
    }
}

<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

class RouteServiceProvider extends ServiceProvider
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
        $this->httpProtocol();
        $this->configRateLimiterForWeb();
        $this->configRateLimiterForApi();
    }

    /**
     * Force the application to use the specified protocol
     *
     * @return void
     */
    private function httpProtocol(): void
    {
        URL::forceScheme(config('app.protocol'));

        if (app()->isProduction()) {
            URL::forceHttps();
        }
    }

    /**
     * Configuring the maximum number of requests per minute for the `web` route group
     *
     * @return void
     */
    private function configRateLimiterForWeb(): void
    {
        RateLimiter::for('web', function (Request $request) {
            return $request->user()
                   ? Limit::perMinute(200)->by($request->user()->getKey())
                   : Limit::perMinute(100)->by($request->ip());
        });
    }

    /**
     * Configuring the maximum number of requests per minute for the `api` route group
     *
     * @return void
     */
    private function configRateLimiterForApi(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return $request->user()
                   ? Limit::perMinute(200)->by($request->user()->getKey())
                   : Limit::perMinute(100)->by($request->ip());
        });
    }
}

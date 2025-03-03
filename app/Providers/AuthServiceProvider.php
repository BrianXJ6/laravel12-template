<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AuthServiceProvider extends ServiceProvider
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
        $this->passwordRules();
    }

    /**
     * Handle default configuration rules for passwords
     *
     * @return void
     */
    protected function passwordRules(): void
    {
        Password::defaults(function () {
            /** @var \Illuminate\Foundation\Application */
            $app = $this->app;
            $rule = Password::min(8);

            return $app->isProduction()
                   ? $rule->symbols()->mixedCase()->letters()->numbers()
                   : $rule;
        });
    }
}

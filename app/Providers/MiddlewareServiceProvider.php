<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use App\Http\Middleware\EnsureFrontendUserIsAuthenticated;


class MiddlewareServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(Router $router): void
    {
        // Registrar middleware com alias
        $router->aliasMiddleware('auth.frontend', EnsureFrontendUserIsAuthenticated::class);
    }
}

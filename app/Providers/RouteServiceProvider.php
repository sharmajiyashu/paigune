<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot(): void
    {
        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('web')
                ->prefix('admin') // Optional prefix for admin routes
                ->as('admin.') // Add a name prefix for admin routes
                ->group(base_path('routes/admin.php'));

            // Route::middleware('web')
            //     ->prefix('dashboard') // Optional prefix for dashboard routes
            //     ->as('dashboard.') // Add a name prefix for dashboard routes
            //     ->group(base_path('routes/dashboard.php'));

            // Route::middleware('api')
            //     ->prefix('api')
            //     ->group(base_path('routes/api.php'));
        });
    }
}

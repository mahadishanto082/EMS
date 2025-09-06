<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/dashboard';
    public const ADMIN_HOME = '/admin/dashboard';
    public const EMPLOYEE_HOME = '/employee/dashboard';

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            // API routes
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

        //    Web routes (default users)

             //Admin routes
             Route::middleware('admin')
                ->prefix('admin')
                ->name('admin.')
                ->group(base_path('routes/admin.php'));
            
            Route::middleware('web')
            ->group(base_path('routes/web.php'));
            

            // Admin routes
          
            // Employee routes
            
        });
        
    }
}

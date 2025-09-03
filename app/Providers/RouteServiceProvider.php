<?php 

namespace App\Providers;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Models\Employee;
use App\Models\Position;
use App\Models\User;
use App\Models\Department;


class RouteServiceProvider extends ServiceProvider
{
    
    
    public const HOME ='/Dashboard';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';
    public const EMPLOYEE_HOME = '/employee/dashboard';
    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot():void
    {
        $this->configureRateLimiting();
        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
        Route::model('employee', Employee::class);
        Route::model('user', User::class);
     
    }
    
}
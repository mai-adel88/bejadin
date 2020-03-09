<?php

namespace App\Providers;

use App\Http\Middleware\Lang;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
        $this->mapWebAdminRoutes();
        $this->mapHrRoutes();
        // $this->mapWebAdmin_2_Routes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebAdminRoutes()
    {
        Route::middleware(['web','lang'])
            ->namespace($this->namespace)
            ->group(base_path('routes/admin.php'));
    }
    // protected function mapWebAdmin_2_Routes()
    // {
    //     Route::middleware(['web','lang'])
    //         ->namespace($this->namespace)
    //         ->group(base_path('routes/admin_2.php'));
    // }
    protected function mapWebRoutes()
    {
        Route::middleware(['web','lang'])
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }

    protected function mapHrRoutes()
    {
        Route::middleware(['web','lang'])
            ->namespace($this->namespace)
            ->group(base_path('routes/hr.php'));
    }
}

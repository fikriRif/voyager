<?php

namespace TCG\Voyager;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class VoyagerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(\Illuminate\Routing\Router $router, \Illuminate\Contracts\Http\Kernel $kernel)
    {
        $router->middleware('admin.user', 'TCG\Voyager\middleware\VoyagerAdminMiddleware');

        $this->loadViewsFrom(__DIR__.'/views', 'voyager');
        define('VOYAGER_ASSETS_PATH', '/vendor/tcg/voyager/assets');

        $this->publishes([
            __DIR__.'/assets' => public_path('vendor/tcg/voyager/assets'),
        ], 'public');

        $this->publishes([
            __DIR__.'/database/migrations/' => database_path('migrations')
        ], 'migrations');

        $user = null;
        view()->share('user', $user);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__.'/routes.php';

        $this->app->make('TCG\Voyager\Models\User');
        $this->app->make('TCG\Voyager\Models\Role');

        $this->app->make('TCG\Voyager\VoyagerController');
        $this->app->make('TCG\Voyager\Controllers\VoyagerUserController');
        $this->app->make('TCG\Voyager\Controllers\VoyagerRoleController');
        $this->app->make('TCG\Voyager\Controllers\VoyagerDevToolsController');
    }
}

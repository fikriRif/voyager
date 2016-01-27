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

        // Publish the assets to the Public folder
        $this->publishes([
            __DIR__.'/assets' => public_path('vendor/tcg/voyager/assets'),
        ], 'public');

        // Publish the migrations to the migrations folder
        $this->publishes([
            __DIR__.'/database/migrations/' => database_path('migrations')
        ], 'migrations');


        include __DIR__.'/routes.php';
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->make('TCG\Voyager\Models\User');
        $this->app->make('TCG\Voyager\Models\Role');
        $this->app->make('TCG\Voyager\Models\DataType');
        $this->app->make('TCG\Voyager\Models\DataRow');

        $this->app->make('TCG\Voyager\VoyagerController');
        $this->app->make('TCG\Voyager\Controllers\VoyagerBuilderController');
        $this->app->make('TCG\Voyager\Controllers\VoyagerBreadController');

        $this->app->make('TCG\Voyager\Controllers\VoyagerUserController');
        $this->app->make('TCG\Voyager\Controllers\VoyagerDevToolsController');
    }

}

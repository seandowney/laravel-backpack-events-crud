<?php

namespace Dowser\BackpackEventsCrud;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class EventsCRUDServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // LOAD THE VIEWS
        // - first the published views (in case they have any changes)
        $this->loadViewsFrom(resource_path('views/vendor/dowser/eventscrud'), 'dowser');
        // - then the stock views that come with the package, in case a published view might be missing
        $this->loadViewsFrom(realpath(__DIR__.'/resources/views'), 'dowser');

        $this->mergeConfigFrom(
            __DIR__.'/config/dowser/eventscrud.php', 'dowser.eventscrud'
        );

        // publish views
        $this->publishes([__DIR__.'/resources/views' => resource_path('views/vendor/dowser/eventscrud')], 'views');

        // publish config file
        $this->publishes([__DIR__.'/config' => config_path()], 'config');

        // publish migrations
        $this->publishes([__DIR__.'/database/migrations' => database_path('migrations')], 'migrations');
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function setupRoutes(Router $router)
    {
        $router->group(['namespace' => 'Dowser\BackpackEventsCrud\app\Http\Controllers'], function ($router) {
            \Route::group(['prefix' => config('backpack.base.route_prefix', 'admin'), 'middleware' => ['web', 'admin'], 'namespace' => 'Admin'], function () {
                \CRUD::resource('event', 'EventCrudController');
            });
        });
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        // register its dependencies
        $this->app->register(\Cviebrock\EloquentSluggable\ServiceProvider::class);

        $this->setupRoutes($this->app->router);
    }
}

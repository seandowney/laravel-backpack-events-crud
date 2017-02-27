<?php

namespace SeanDowney\BackpackEventsCrud;

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
        $this->loadViewsFrom(resource_path('views/vendor/seandowney/eventscrud'), 'seandowney');
        // - then the stock views that come with the package, in case a published view might be missing
        $this->loadViewsFrom(realpath(__DIR__.'/resources/views'), 'seandowney');

        $this->mergeConfigFrom(
            __DIR__.'/config/seandowney/eventscrud.php', 'seandowney.eventscrud'
        );

        // publish views
        $this->publishes([__DIR__.'/resources/views' => resource_path('views/vendor/seandowney/eventscrud')], 'views');

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
        $router->group(['namespace' => 'SeanDowney\BackpackEventsCrud\app\Http\Controllers'], function ($router) {
            \Route::group(['prefix' => config('backpack.base.route_prefix', 'admin'), 'middleware' => ['web', 'admin'], 'namespace' => 'Admin'], function () {
                \CRUD::resource('event', 'EventCrudController');
                \CRUD::resource('venue', 'VenueCrudController');
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

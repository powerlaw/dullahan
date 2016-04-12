<?php

namespace Powerlaw\Eunomia;

use Illuminate\Support\ServiceProvider;

class EunomiaServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/eunomia.php' => config_path('eunomia.php'),
        ]);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/eunomia.php' ,'eunomia'
        );
        $this->app->singleton('id', function($app)
        {
            return new Eunomia;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['id'];
    }
}
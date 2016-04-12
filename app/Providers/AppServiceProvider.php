<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use Config;
use Log;

class AppServiceProvider extends ServiceProvider
{
    protected $env;
    function __construct($app)
    {
        parent::__construct($app);
        $this->env = $app->environment();
        $this->start = microtime(true);
    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->initDbListen();
        $this->initAppTerminating();
        $this->initLogListen();
        $this->initBugsnag();
    }

    private function initDbListen()
    {
        DB::listen(function($query) {
            $bindings = $query->bindings;
            $sql = $query->sql;
            $time = $query->time;
            $data = compact('bindings', 'time', 'name');
            $sql = $this->app->make('helper')->sql()->raw($sql,$bindings);
            config('livius.sql.enable',true) && $this->app->make('logger')->sql($sql, $data);
        });
    }
    private function initLogListen()
    {
        Log::listen(function($level, $message, $context){
        });

    }
    private function initAppTerminating()
    {
        $this->app->terminating(function(){
        });
    }
    private function initBugsnag()
    {
//        Bugsnag::setErrorReportingLevel(Config::get('bugsnag.notify_level'));
//        Bugsnag::setReleaseStage(Config::get('bugsnag.notify_release_stages'));
//        Bugsnag::setBeforeNotifyFunction(function($error){
//            $error->setMetaData(Config::get('bugsnag.meta'));
//        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->setDefaltTimezone();
        $this->setPhpIni();
        $this->setDBQueryLog();
        $this->registerProviders();
        $this->createAliases();
    }
    private function setDefaltTimezone()
    {
        date_default_timezone_set('PRC');
    }
    private function setPhpIni()
    {
    }
    private function setDBQueryLog()
    {
        DB::enableQueryLog();
    }
    private function registerProviders()
    {
        $defaultProviders = Config::get("vendor.providers._default",[]);
        $envProviders = Config::get("vendor.providers.{$this->env}",[]);
        $providers = array_unique(array_merge($defaultProviders,$envProviders));
        foreach($providers as $provider)
        {
            if (class_exists($provider)){
                $this->app->register($provider);
            }
        }
    }

    private function createAliases()
    {
        $defaultAliases = Config::get("vendor.aliases._default",[]);
        $envAliases = Config::get("vendor.aliases.{$this->env}",[]);
        $aliases = array_unique(array_merge($defaultAliases,$envAliases));
        foreach($aliases as $alias => $abstract)
        {
            if (class_exists($abstract)){
                $this->app->alias($abstract,$alias);
            }
        }
    }
}

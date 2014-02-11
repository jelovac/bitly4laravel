<?php namespace Jelovac\Bitly4laravel;

use Illuminate\Support\ServiceProvider;

class Bitly4laravelServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('jelovac/bitly4laravel');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['bitly4laravel'] = $this->app->share(function($app) {
            $config = $app['config']->get('bitly4laravel::config');
            return new Bitly4laravel($config);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('bitly4laravel');
    }

}
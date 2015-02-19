<?php namespace Jelovac\Bitly4laravel\ServiceProviders;

use Illuminate\Support\ServiceProvider;

class Laravel4ServiceProvider extends ServiceProvider {

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
            $config = $app['config']->get('bitly4laravel::bitly4laravel');
            return new Bitly4laravel($config);
        });
    }

}

<?php namespace Jelovac\Bitly4laravel\ServiceProviders;

use \Illuminate\Support\ServiceProvider;

class Laravel5ServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__ . '/../config/bitly4laravel.php';

        $paths = array(
            $configPath => config_path("bitly4laravel.php"),
        );

        $this->publishes($paths, 'config');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['bitly4laravel'] = $this->app->share(function($app) {
            $config = $app['config']->get('bitly4laravel');
            return new Bitly4laravel($config);
        });
    }

}

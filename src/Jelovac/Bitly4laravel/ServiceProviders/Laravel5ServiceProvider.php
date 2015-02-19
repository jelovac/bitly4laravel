<?php namespace Jelovac\Bitly4laravel\ServiceProviders;

use Illuminate\Support\ServiceProvider;
use Jelovac\Bitly4laravel\Bitly4laravel;

class Laravel5ServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__ . '/../../../config/config.php';
        $paths = array(
            $configPath => config_path("packages/jelovac/bitly4laravel/config.php"),
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
        $configPath = config_path("packages/jelovac/bitly4laravel/config.php");
        $this->mergeConfigFrom($configPath, 'bitly4laravel');
        $this->app['bitly4laravel'] = $this->app->share(function($app) {
            $config = $app['config']->get('bitly4laravel');
            return new Bitly4laravel($config);
        });
    }

}

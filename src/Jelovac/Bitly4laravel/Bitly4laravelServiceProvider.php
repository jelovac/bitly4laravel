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
        $configPath = __DIR__ . '/../config/bitly4laravel.php';

        $this->mergeConfigFrom($configPath, 'bitly4laravel');

        $this->app['bitly4laravel'] = $this->app->share(function($app) {
            return new Bitly4laravel($app['config']);
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

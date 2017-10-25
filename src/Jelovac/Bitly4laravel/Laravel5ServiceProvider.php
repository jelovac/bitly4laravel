<?php namespace Jelovac\Bitly4laravel;

use \Illuminate\Support\ServiceProvider;

class Laravel5ServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__ . '/../../config/config.php';

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
        $this->app->bind('bitly4laravel', Bitly4laravel::class);
        
        $this->app->singleton(Bitly4laravel::class, function($app) {
            $config = $app['config']['bitly4laravel'];
            return new Bitly4laravel($config);
        });
    }

}

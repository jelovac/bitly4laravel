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
        $configPath = __DIR__ . '/../../config/bitly4laravel.php';

        $paths = array(
            $configPath => $this->config_path("bitly4laravel.php"),
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
        $configPath = __DIR__ . '/../../config/bitly4laravel.php';

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

    /**
     * Merge the given configuration with the existing configuration.
     *
     * @param  string  $path
     * @param  string  $key
     * @return void
     */
    protected function mergeConfigFrom($path, $key)
    {
        if (is_callable('parent::mergeConfigFrom')) {
            parent::mergeConfigFrom($path, $key);
        } else {
            $config = $this->app['config']->get($key, []);
            $this->app['config']->set($key, array_merge(require $path, $config));
        }
    }

    /**
     * Get the configuration path.
     *
     * @param  string  $path
     * @return string
     */
    protected function config_path($path = '')
    {
        if (!function_exists('config_path')) {
            return $this->app->make('path.config') . ($path ? '/' . $path : $path);
        } else {
            return config_path($path);
        }
    }

}

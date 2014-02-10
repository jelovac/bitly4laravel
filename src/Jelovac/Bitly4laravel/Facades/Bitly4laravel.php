<?php namespace Jelovac\Bitly4laravel\Facades;

use Illuminate\Support\Facades\Facade;

class Bitly4laravel extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bitly4laravel';
    }

}
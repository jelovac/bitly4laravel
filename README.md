bitly4laravel
=============

Provides basic bitly API to use with Laravel 4.

Instalation
===========

Add bitly4laravel to your composer.json file.

    require : {
        "laravel/framework": "4.0.*",
        "jelovac/bitly4laravel": "dev-master"
    }

Or with composer command:

    composer require "jelovac/bitly4laravel": "dev-master"

Add provider to your app/config/app.php providers

    Jelovac\Bitly4laravel\Bitly4laravelServiceProvider

Optional (recommended)
======================

Add alias to app/config/app.php aliases

    'Bitly' => 'VladimirJelovac\Bitly4laravel\Facades\Bitly4laravel'

About
=====

Converted bitly-url-shortener yii framework extension to a Laravel package.

The original YII extension you can download here: 
http://www.yiiframework.com/extension/bitly-url-shortener
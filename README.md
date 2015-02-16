bitly4laravel
=============
[![Build Status](https://travis-ci.org/jelovac/bitly4laravel.png?branch=master)](https://travis-ci.org/jelovac/bitly4laravel) [![Latest Stable Version](https://poser.pugx.org/jelovac/bitly4laravel/v/stable.png)](https://packagist.org/packages/jelovac/bitly4laravel) [![Total Downloads](https://poser.pugx.org/jelovac/bitly4laravel/downloads.png)](https://packagist.org/packages/jelovac/bitly4laravel) [![Latest Unstable Version](https://poser.pugx.org/jelovac/bitly4laravel/v/unstable.png)](https://packagist.org/packages/jelovac/bitly4laravel) [![License](https://poser.pugx.org/jelovac/bitly4laravel/license.png)](https://packagist.org/packages/jelovac/bitly4laravel)

Provides a Laravel package to communicate with Bit.ly API.

In order to use this package you need to get [OAuth Generic Access Token](https://bitly.com/a/oauth_apps) from Bitly website.

Instalation
===========

Add bitly4laravel to your composer.json file.

    require : {
        "jelovac/bitly4laravel": "3.*"
    }

Or with composer command:

    composer require "jelovac/bitly4laravel": "3.*"

Add provider to your app/config/app.php providers

    'Jelovac\Bitly4laravel\Bitly4laravelServiceProvider',

Publish config

For Laravel 5 use:

    php artisan vendor:publish

For Laravel 4 use:

    php artisan config:publish jelovac/bitly4laravel

Optional (recommended)
======================

Add alias to app/config/app.php aliases

    'Bitly' => 'Jelovac\Bitly4laravel\Facades\Bitly4laravel',

Usage
=====

Shorten links

    Bitly::shorten('http://google.com/');

    Response format: JSON

    {
        "data": {
          "global_hash": "900913",
          "hash": "ze6poY",
          "long_url": "http://google.com/",
          "new_hash": 0,
          "url": "http://bit.ly/ze6poY"
        },
        "status_code": 200,
        "status_txt": "OK"
    }

Expand links

    Bitly::expand('http://bit.ly/ze6poY');

    Response format: JSON

    {
        "data": {
          "expand": [
            {
              "global_hash": "900913",
              "long_url": "http://google.com/",
              "short_url": "http://bit.ly/ze6poY",
              "user_hash": "ze6poY"
            }
          ]
        },
        "status_code": 200,
        "status_txt": "OK"
    }

Repository
==========
https://github.com/jelovac/bitly4laravel

License
=======

The Bitly4laravel package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

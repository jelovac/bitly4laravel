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

    'Jelovac\Bitly4laravel\Bitly4laravelServiceProvider',

Optional (recommended)
======================

Add alias to app/config/app.php aliases

    'Bitly' => 'Jelovac\Bitly4laravel\Facades\Bitly4laravel',

About
=====

Converted bitly-url-shortener yii framework extension to a Laravel package.

The original YII extension you can download here: 
http://www.yiiframework.com/extension/bitly-url-shortener

Credits
=======



bitly-url-shortener - [a link](https://github.com/VinceG) [a name](Vadim Gabriel)

laravel4bitly - [a link](https://github.com/jelovac) [a name](Vladimir Jelovac)

License
=======

Copyright (c) 2013, Vladimir Jelovac
All rights reserved.

Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:

1. Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.

2. Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
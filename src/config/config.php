<?php

/**
 * Configuraton file for bitly4laravel
 * Populate only the needed fields and comment others
 */
return array(
    "api_url" => "https://api-ssl.bitly.com/",
    "api_version" => "v3/",
    "access_token" => null,
    "use_cache" => false,
    "cache_key" => "Laravel.Bitly.",
    "cache_duration" => 3600,
    "response_format" => "json",
    "connection_options" => array(),
    "request_options" => array(),
    "request_type" => "get",
);

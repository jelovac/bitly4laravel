<?php
/**
 * Configuraton file for bitly4laravel
 * Populate only the needed fields and comment/remove the others
 */
return array(
    "access_token" => null,
    "cache_enabled" => false,
    "cache_duration" => 3600, // Duration in minutes
    "cache_key_prefix" => "Bitly4Laravel.",
    "response_format" => "json", // json, xml
    "request_type" => "get", // get, post
    "request_options" => array(),
    "client_config" => array(),
);

<?php

/**
 * Configuraton file for bitly4laravel
 * Populate only the needed fields and comment others
 */
return array(
    'access_token' => null,
    // Cache enabled?
    'use_cache' => false,
    // Cache Duration in minutes
    'cache_expires' => 3600, // Default 3600 = 24 h - 1 Day
    // Unique cache key
    'cache_key' => 'Laravel.Bitly.',
    // Format to fetch from Bitly API: json, xml
    'format' => 'json',
    // variable output: string, object, array
    'variable_output' => 'array',
    // default get call type (look at bitly api for more information)
    'call_type' => 'shorten',
    // cURL connection options
    'connection_options' => array()
);
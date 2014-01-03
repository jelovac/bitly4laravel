<?php

/**
 * Configuraton file for bitly4laravel
 * Populate only the needed fields and comment others
 */
return array(
    // Bitly username
    'username' => 'your-username',
    // Bitly password
    'password' => 'your-password',
    // Bitly Deprecated API key
    'api_key' => 'your-api-key',
    // Bitly Application ID
    'client_id' => 'your-client-id',
    // Bitly Application Secret
    'client_secret' => 'your-client-secret',
    // oAuth Generic Access Token
    'access_token' => 'your-access-token',
    // Cache enabled?
    'use_cache' => true,
    // Cache Duration in minutes
    'cache_expires' => 3600, // Default 3600 = 24 h - 1 Day
    // Unique cache key
    'cache_key' => 'Laravel.Bitly.',
    // Format to fetch from Bitly API: json, xml
    'format' => 'json',
    // variable output: string, object, array
    'variable_output' => 'array',
    // default call type (look at bitly api for more information)
    'call_type' => 'shorten'
);
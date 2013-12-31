<?php

namespace Jelovac\Bitly4laravel;

use Cache,
    Log,
    Carbon,
    Jelovac\Bitly4laravel\Connection;

class OAuth {

    /**
     * 
     */
    const API_URL = "https://api-ssl.bitly.com/";

    /**
     * 
     */
    const AUTH_URL = "https://bitly.com/oauth/authorize";

    /**
     *
     * @var type 
     */
    private static $login = null;

    /**
     *
     * @var type 
     */
    private static $key = null;

    /**
     *
     * @var type 
     */
    private static $accessToken = null;

    /**
     *
     * @var type 
     */
    private static $clientId = null;

    /**
     *
     * @var type 
     */
    private static $clientSecret = null;

    /**
     *
     * @var type 
     */
    private static $redirectURI = null;

    /**
     * Using constructor to get configuration options
     * @param array $config
     */
    public function __construct(array $config) {
        if (isset($config['login'])) {
            static::$login = $config['login'];
        }
        if (isset($config['key'])) {
            static::$key = $config['key'];
        }
        if (isset($config['oauth_access_token'])) {
            static::$accessToken = $config['oauth_access_token'];
        }
        if (isset($config['oauth_client_id'])) {
            static::$clientId = $config['oauth_client_id'];
        }
        if (isset($config['oauth_client_secret'])) {
            static::$clientSecret = $config['oauth_client_secret'];
        }
        if (isset($config['oauth_redirect_uri'])) {
            static::$redirectURI = $config['oauth_redirect_uri'];
        }
    }

    private function authorize($clientId = null, $clientSecret = null, $redirectURI = null) {
        $data = "client_id=" . static::$clientId;
        $data .= "&client_secret=" . static::$clientSecret;
        $data .= "&redirect_uri=" . static::$redirectURI;
        $url = urlencode($url) = static::AUTH_URL . "?" . $data;
        // returned value is multi dimensional array
        $connection = Connection::make($url);
        
    }

}

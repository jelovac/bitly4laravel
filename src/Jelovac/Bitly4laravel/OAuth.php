<?php

namespace Jelovac\Bitly4laravel;

use Cache,
    Log,
    Carbon,
    Jelovac\Bitly4laravel\Connection;

class OAuth {

    /**
     * The URL of bitly API
     */
    const API_URL = "https://api-ssl.bitly.com/";

    /**
     * Bitly authorization URL
     */
    const AUTH_URL = "https://bitly.com/oauth/authorize";

    /**
     * Bitly username
     * @var string 
     */
    private $login = null;

    /**
     * Old bitly API KEY
     * @var string 
     */
    private $key = null;

    /**
     * Bitly Generic Access Token
     * @var string 
     */
    private $accessToken = null;

    /**
     * Bittly Application Client ID
     * @var string 
     */
    private $clientId = null;

    /**
     * Bitly Application Client Secret
     * @var string 
     */
    private $clientSecret = null;

    /**
     * Bitly Application Redirect URL (Callback)
     * @var string 
     */
    private $redirectURI = null;

    /**
     * Bitly username
     * @var string
     */
    private $username = null;

    /**
     * Bitly password
     * @var string
     */
    private $password = null;

    /**
     * Using constructor to get configuration options
     * @param array $config
     */
    public function __construct(array $config) {
        if (isset($config['login'])) {
            $this->login = $config['login'];
        }
        if (isset($config['key'])) {
            $this->key = $config['key'];
        }
        if (isset($config['oauth_access_token'])) {
            $this->accessToken = $config['oauth_access_token'];
        }
        if (isset($config['oauth_client_id'])) {
            $this->clientId = $config['oauth_client_id'];
        }
        if (isset($config['oauth_client_secret'])) {
            $this->clientSecret = $config['oauth_client_secret'];
        }
        if (isset($config['oauth_redirect_uri'])) {
            $this->redirectURI = $config['oauth_redirect_uri'];
        }
    }

    /**
     * Method for retrieving Bitly oAuth Access Token
     * @param type $username
     * @param type $password
     * @param type $clientId
     * @param type $clientSecret
     */
    public function getAccessToken($username = null, $password = null, $clientId = null, $clientSecret = null) {
        if ($username !== null && $password !== null && $clientId !== null && $clientSecret !== null) {
            $this->username = $username;
            $this->password = $password;
            $this->clientId = $clientId;
            $this->clientSecret = $clientSecret;
        } elseif ($username !== null && $password !== null) {
            $this->username = $username;
            $this->password = $password;
        }

        if ($this->username !== null && $this->password !== null && $this->clientId !== null && $this->clientSecret !== null) {
            $authorization = "Basic " . base64_encode(($this->username . ":" . $this->password));

            $url = static::API_URL . "oauth/access_token";

            $options = array(
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => array(
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret
                ),
                CURLOPT_HEADER => array(
                    "Authorization: $authorization",
                    "Content-Type: application/x-www-form-urlencoded"
                )
            );

            $connection = Connection::make($url, $options);
            
            return $connection;
            
        } else {
            throw new Exception("Authorization data is not properly set.");
        }
    }

    public function shorten($url) {
        
    }

}

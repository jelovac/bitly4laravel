<?php

namespace Jelovac\Bitly4laravel;

class OAuth {

    /**
     * The URL of bitly API
     */
    private static $apiURL = "https://api-ssl.bitly.com/";

    /**
     * Bitly authorization URL
     */
    private static $authURL = "https://bitly.com/oauth/authorize";

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
    public function __construct(array $config)
    {
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

    public function getAccessToken($clientId = null, $redirectURI = null)
    {
        if ($clientId !== null && $redirectURI !== null) {
            $this->redirectURI = $redirectURI;
            $this->clientId = $clientId;
        }
        if ($this->redirectURI !== null && $this->clientId !== null) {
            $url = static::$authURL . "?client_id=" . $this->clientId;
            $url .= "&redirect_uri=" . urldecode($this->redirectURI);
            $options = array(
                CURLOPT_HEADER => array(
                    'Content-Type: application/json'
                )
            );
            $connection = Connection::make($url, $options);
            // TO DO ...
        } else {
            throw new Exception("Authorization data is not properly set.");
        }
    }

}
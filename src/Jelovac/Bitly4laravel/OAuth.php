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
    private $login = null;

    /**
     *
     * @var type 
     */
    private $key = null;

    /**
     *
     * @var type 
     */
    private $accessToken = null;

    /**
     *
     * @var type 
     */
    private $clientId = null;

    /**
     *
     * @var type 
     */
    private $clientSecret = null;

    /**
     *
     * @var type 
     */
    private $redirectURI = null;

    /**
     * 
     */
    private $username = null;

    /**
     * 
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
     * This method needs more research
     * Need to chech if its possible to retrieve access token 
     * without user confirmation
     * @param type $clientId
     * @param type $clientSecret
     * @param type $redirectURI
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

        $authorization = "Basic " . base64_encode($this->clientId . ":" . $this->clientSecret);

        $url = static::API_URL . "oauth/access_token";

        $options = array(
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => array(
                'grant_type' => 'password',
                'username' => $this->username,
                'password' => $this->password
            ),
            CURLOPT_HEADER => array(
                'Authorization: ' . $authorization,
                'Content-Type: application/x-www-form-urlencoded'
            )
        );

        $response = Connection::make($url, $options);
    }

    public function shorten($url) {
        
    }

}

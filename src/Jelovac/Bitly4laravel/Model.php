<?php

namespace Jelovac\Bitly4laravel;

class Model {

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
     * Bitly generic access token
     * @var string 
     */
    private $accessToken = null;

    /**
     * Bitly API key !deprecated
     * @var string
     */
    private $apiKey = null;

    /**
     * Bitly app client ID
     * @var string
     */
    private $clientId = null;

    /**
     * Bitly app client secret
     * @var string
     */
    private $clientSecret = null;

    /**
     * Enable cache
     * @var boolean 
     */
    private $useCache = false;

    /**
     * Cache key
     * @var string 
     */
    private static $cacheKey = "Laravel.bitly.Class.Cache.";

    /**
     * Cache duration in minutes
     * @var integer 
     */
    private $cacheDuration = 3600;

    /**
     * Default format, values can be json, xml, array
     * @var string 
     */
    private $format = 'xml';

    /**
     * Default callback call type
     * @var string
     */
    private $callType = "shorten";

    /**
     *
     * @var type 
     */
    private $cache = null;

    /**
     * Storing the connection response into multidimensional array
     * [response]
     *      [headers]
     *      [content]
     * [error]
     *      [number]
     *      [message]
     * @var array 
     */
    private $response = null;

    /**
     * Storing response data
     * @var mixed 
     */
    private $responseData = null;

    function __construct(array $config)
    {
        $this->username = isset($config['username']) ? $config['username'] : $this->username;
        $this->password = isset($config['password']) ? $config['password'] : $this->password;
        $this->accessToken = isset($config['access_token']) ? $config['access_token'] : $this->accessToken;
        $this->apiKey = isset($config['api_key']) ? $config['api_key'] : $this->apiKey;
        $this->clientId = isset($config['client_id']) ? $config['client_id'] : $this->clientId;
        $this->clientSecret = isset($config['client_secret']) ? $config['client_secret'] : $this->clientSecret;
        $this->useCache = isset($config['use_cache']) ? $config['use_cache'] : $this->useCache;
        self::$cacheKey = isset($config['cache_key']) ? $config['cache_key'] : self::$cacheKey;
        $this->cacheDuration = isset($config['cache_duration']) ? $config['cache_duration'] : $this->cacheDuration;
        $this->format = isset($config['format']) ? $config['format'] : $this->format;
        $this->callType = isset($config['call_type']) ? $config['call_type'] : $this->callType;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public function getApiKey()
    {
        return $this->apiKey;
    }

    public function getClientId()
    {
        return $this->clientId;
    }

    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    public function getUseCache()
    {
        return $this->useCache;
    }

    public static function getCacheKey()
    {
        return self::$cacheKey;
    }

    public function getCacheDuration()
    {
        return $this->cacheDuration;
    }

    public function getFormat()
    {
        return $this->format;
    }

    public function getCallType()
    {
        return $this->callType;
    }

    public function getCache()
    {
        return $this->cache;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function getResponseData()
    {
        return $this->responseData;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;
    }

    public function setUseCache($useCache)
    {
        $this->useCache = $useCache;
    }

    public static function setCacheKey($cacheKey)
    {
        self::$cacheKey = $cacheKey;
    }

    public function setCacheDuration($cacheDuration)
    {
        $this->cacheDuration = $cacheDuration;
    }

    public function setFormat($format)
    {
        $this->format = $format;
    }

    public function setCallType($callType)
    {
        $this->callType = $callType;
    }

    public function setCache(type $cache)
    {
        $this->cache = $cache;
    }

    public function setResponse($response)
    {
        $this->response = $response;
    }

    public function setResponseData($responseData)
    {
        $this->responseData = $responseData;
    }

}
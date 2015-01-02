<?php

namespace Jelovac\Bitly4laravel;

class Model
{

    /**
     * Bitly API URL
     * @var string
     */
    public static $apiURL = "https://api-ssl.bitly.com/";

    /**
     * Bitly api version to use
     * @var string
     */
    public static $apiVersion = "v3/";

    /**
     * Bitly generic access token
     * @var string
     */
    private $accessToken = null;

    /**
     * Enable cache
     * @var boolean
     */
    protected $useCache = false;

    /**
     * Cache key
     * @var string
     */
    protected $cacheKey = "Laravel.Bitly.";

    /**
     * Cache duration in minutes
     * @var integer
     */
    protected $cacheDuration = 3600;

    /**
     * Default response format, values can be json, xml
     * @var string
     */
    protected $responseFormat = 'json';

    /**
     * GuzzleHttp Client configuration settings
     * @var array
     */
    protected $connectionOptions = array();

    /**
     * GuzzleHttp Client request options
     * @var array
     */
    protected $requestOptions = array();

    /**
     * Request parameters
     * @var array
     */
    protected $requestParams = array();

    /**
     * Request Type (get/post)
     * @var string
     */
    protected $requestType = "get";

    public function __construct(array $config = array())
    {
        self::$apiURL = isset($config['api_url']) ? $config['api_url'] : self::$apiURL;
        self::$apiVersion = isset($config['api_version']) ? $config['api_version'] : self::$apiVersion;
        $this->accessToken = isset($config['access_token']) ? $config['access_token'] : $this->accessToken;
        $this->useCache = isset($config['use_cache']) ? $config['use_cache'] : $this->useCache;
        $this->cacheKey = isset($config['cache_key']) ? $config['cache_key'] : $this->cacheKey;
        $this->cacheDuration = isset($config['cache_duration']) ? $config['cache_duration'] : $this->cacheDuration;
        $this->responseFormat = isset($config['response_format']) ? $config['response_format'] : $this->responseFormat;
        $this->connectionOptions = isset($config['connection_options']) ? $config['connection_options'] : $this->connectionOptions;
        $this->requestOptions = isset($config['request_options']) ? $config['request_options'] : $this->requestOptions;
        $this->requestType = isset($config['request_type']) ? $config['request_type'] : $this->requestType;
    }

    /**
     * Get API URL
     * @return string
     */
    public static function getApiURL()
    {
        return self::$apiURL;
    }

    /**
     * Get API VERSION
     * Used for URL building
     * @return string
     */
    public static function getApiVersion()
    {
        return self::$apiVersion;
    }

    /**
     * Get Bit.ly Generic OAuth Access Token
     * @return type
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * Get if the cache is enabled or not
     * @return boolean
     */
    public function getUseCache()
    {
        return $this->useCache;
    }

    /**
     * Get cache key (unique prefix)
     * @return type
     */
    public function getCacheKey()
    {
        return $this->cacheKey;
    }

    /**
     * Get cache duration in minutes
     * @return type
     */
    public function getCacheDuration()
    {
        return $this->cacheDuration;
    }

    /**
     * Get response format (json/xml)
     * @return type
     */
    public function getResponseFormat()
    {
        return $this->responseFormat;
    }

    /**
     * Get GuzzleHttp\Client config options
     * @return array
     */
    public function getConnectionOptions()
    {
        return $this->connectionOptions;
    }

    /**
     * Get GuzzleHttp\Client request options
     * @return array
     */
    public function getRequestOptions()
    {
        return $this->requestOptions;
    }

    /**
     * Get request params
     * @return array
     */
    public function getRequestParams()
    {
        return $this->requestParams;
    }

    /**
     * Get request type (get/post)
     * @return string
     */
    public function getRequestType()
    {
        return $this->requestType;
    }

    /**
     * Set API URL
     * @param string $apiURL
     * @return self
     */
    public static function setApiURL($apiURL)
    {
        self::$apiURL = $apiURL;
        return self;
    }

    /**
     * Set API VERSION
     * @param string $apiVersion
     * @return self
     */
    public static function setApiVersion($apiVersion)
    {
        self::$apiVersion = $apiVersion;
        return self;
    }

    /**
     * Set Bit.ly Generic OAuth Access Token
     * @param string $accessToken
     * @return \Jelovac\Bitly4laravel\Model
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    /**
     * Set use cache (Enables/Disables caching)
     * @param boolean $useCache
     * @return \Jelovac\Bitly4laravel\Model
     */
    public function setUseCache($useCache)
    {
        $this->useCache = $useCache;
        return $this;
    }

    /**
     * Set cache key (prefix)
     * @param string $cacheKey
     * @return \Jelovac\Bitly4laravel\Model
     */
    public function setCacheKey($cacheKey)
    {
        $this->cacheKey = $cacheKey;
        return $this;
    }

    /**
     * Set cache duration in minutes
     * @param int $cacheDuration
     * @return \Jelovac\Bitly4laravel\Model
     */
    public function setCacheDuration($cacheDuration)
    {
        $this->cacheDuration = $cacheDuration;
        return $this;
    }

    /**
     * Set response format (json/xml)
     * @param string $responseFormat
     * @return \Jelovac\Bitly4laravel\Model
     */
    public function setResponseFormat($responseFormat)
    {
        $this->responseFormat = $responseFormat;
        return $this;
    }

    /**
     * Set GuzzleHttp\Client config options
     * @param array $connectionOptions
     * @return \Jelovac\Bitly4laravel\Model
     */
    public function setConnectionOptions(array $connectionOptions)
    {
        $this->connectionOptions = $connectionOptions;
        return $this;
    }

    /**
     * Set GuzzleHttp\Client request options
     * @param array $requestOptions
     * @return \Jelovac\Bitly4laravel\Model
     */
    public function setRequestOptions(array $requestOptions)
    {
        $this->requestOptions = $requestOptions;
        return $this;
    }

    /**
     * Set request params
     * @param string $key
     * @param mixed $value
     * @return \Jelovac\Bitly4laravel\Model
     */
    public function setRequestParams($key, $value)
    {
        if ($value !== null) {
            $this->requestParams[$key] = $value;
        }
        return $this;
    }

    /**
     * Set request type (get/post)
     * @param string $requestType
     * @return \Jelovac\Bitly4laravel\Model
     */
    public function setRequestType($requestType)
    {
        $this->requestType = $requestType;
        return $this;
    }

}

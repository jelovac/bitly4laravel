<?php

namespace Jelovac\Bitly4laravel;

class Model {

    /**
     * Bitly generic access token
     * @var string 
     */
    private $accessToken = null;

    /**
     * Enable cache
     * @var boolean 
     */
    private $useCache = false;

    /**
     * Cache key
     * @var string 
     */
    private static $cacheKey = "Laravel.Bitly.";

    /**
     * Cache duration in minutes
     * @var integer 
     */
    private $cacheDuration = 3600;

    /**
     * Default format, values can be json, xml, array
     * @var string 
     */
    private $format = 'json';

    /**
     * If true convert from format to object or array depending on the format
     * object, array, string
     * @var string 
     */
    private $variableOutput = "array";

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
    public $response = null;

    /**
     * Storing response data
     * @var mixed 
     */
    private $responseData = null;

    function __construct(array $config)
    {

        $this->accessToken = isset($config['access_token']) ? $config['access_token'] : $this->accessToken;
        $this->useCache = isset($config['use_cache']) ? $config['use_cache'] : $this->useCache;
        self::$cacheKey = isset($config['cache_key']) ? $config['cache_key'] : self::$cacheKey;
        $this->cacheDuration = isset($config['cache_duration']) ? $config['cache_duration'] : $this->cacheDuration;
        $this->format = isset($config['format']) ? $config['format'] : $this->format;
        $this->callType = isset($config['call_type']) ? $config['call_type'] : $this->callType;
        $this->variableOutput = isset($config['variable_output']) ? $config['variable_output'] : $this->variableOutput;
    }

    public function getAccessToken()
    {
        return $this->accessToken;
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

    public function getVariableOutput()
    {
        return $this->variableOutput;
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

    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
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

    public function setVariableOutput($variableOutput)
    {
        $this->variableOutput = $variableOutput;
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
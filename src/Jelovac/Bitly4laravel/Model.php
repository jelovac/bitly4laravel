<?php namespace Jelovac\Bitly4laravel;

class Model
{

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
     * If true send post request
     * @var boolean 
     */
    private $postRequest = false;

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

    /**
     * Storing cURL connection options
     * @var array 
     */
    private $connectionOptions = array();

    function __construct(array $config)
    {

        $this->accessToken = isset($config['access_token']) ? $config['access_token'] : $this->accessToken;
        $this->useCache = isset($config['use_cache']) ? $config['use_cache'] : $this->useCache;
        self::$cacheKey = isset($config['cache_key']) ? $config['cache_key'] : self::$cacheKey;
        $this->cacheDuration = isset($config['cache_duration']) ? $config['cache_duration'] : $this->cacheDuration;
        $this->format = isset($config['format']) ? $config['format'] : $this->format;
        $this->callType = isset($config['call_type']) ? $config['call_type'] : $this->callType;
        $this->variableOutput = isset($config['variable_output']) ? $config['variable_output'] : $this->variableOutput;
        $this->connectionOptions = isset($config['connection_options']) ? $config['connection_options'] : $this->connectionOptions;
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

    public function getPostRequest()
    {
        return $this->postRequest;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function getResponseData()
    {
        return $this->responseData;
    }

    public function getConnectionOptions()
    {
        return $this->connectionOptions;
    }

    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    public function setUseCache($useCache)
    {
        $this->useCache = $useCache;
        return $this;
    }

    public static function setCacheKey($cacheKey)
    {
        self::$cacheKey = $cacheKey;
        return self;
    }

    public function setCacheDuration($cacheDuration)
    {
        $this->cacheDuration = $cacheDuration;
        return $this;
    }

    public function setFormat($format)
    {
        $this->format = $format;
        return $this;
    }

    public function setVariableOutput($variableOutput)
    {
        $this->variableOutput = $variableOutput;
        return $this;
    }

    public function setCallType($callType)
    {
        $this->callType = $callType;
        return $this;
    }

    public function setCache(type $cache)
    {
        $this->cache = $cache;
        return $this;
    }

    public function setPostRequest($postRequest)
    {
        $this->postRequest = $postRequest;
        return $this;
    }

    public function setResponse($response)
    {
        $this->response = $response;
        return $this;
    }

    public function setResponseData($responseData)
    {
        $this->responseData = $responseData;
        return $this;
    }

    public function setConnectionOptions($connectionOptions)
    {
        $this->connectionOptions = $connectionOptions;
        return $this;
    }

}

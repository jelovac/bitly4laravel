<?php namespace Jelovac\Bitly4laravel;

use \OutOfRangeException;
use \InvalidArgumentException;
use \Jelovac\Bitly4laravel\Exceptions\Type\NonStringTypeException;
use \Jelovac\Bitly4laravel\Exceptions\Type\NonBooleanTypeException;
use \Jelovac\Bitly4laravel\Exceptions\Type\NonIntegerTypeException;

class Model {

    /**
     * Bit.ly API URL
     */
    const API_URL = "https://api-ssl.bitly.com";

    /**
     * Bit.ly API version
     */
    const API_VERSION = "v3";

    /**
     * Bitly Generic OAuth access token
     *
     * @var string
     */
    protected $accessToken = null;

    /**
     * Enable caching
     * @var bool
     */
    protected $cacheEnabled = false;

    /**
     * Cache duration in minutes
     *
     * @var int
     */
    protected $cacheDuration = 3600;

    /**
     * Cache key prefix
     *
     * @var string
     */
    protected $cacheKeyPrefix = "Laravel.Bitly.";

    /**
     * GuzzleHttp Client configuration
     *
     * @var array
     */
    protected $clientConfig = array();

    /**
     * Response format. Can be either json or xml
     *
     * @var string
     */
    protected $responseFormat = "json";

    /**
     * GuzzleHttp client request options
     *
     * @var array
     */
    protected $requestOptions = array();

    /**
     * Request params
     *
     * @var array
     */
    protected $requestParams = array();

    /**
     * Request type, can be either get or post
     *
     * @var string
     */
    protected $requestType = "get";

    /**
     * Constructor
     *
     * @param array $config
     */
    public function __construct(array $config = array())
    {
        if (!empty($config)) {
            $this->setConfig($config);
        }
    }

    /**
     * Set configuration
     *
     * @param array $config
     * @return \Jelovac\Bitly4laravel\Model
     * @throws InvalidArgumentException
     */
    public function setConfig(array $config)
    {
        foreach ($config as $key => $value) {
            if (is_string($key)) {
                $key = "set_" . $key;
                $name = $this->snakeCaseToCamelCase($key);
                $this->callSetter($name, $value);
            } else {
                throw new InvalidArgumentException("Invalid config key set!");
            }
        }

        return $this;
    }

    /**
     * Call the setter method
     *
     * @param type $name
     * @param type $value
     * @throws InvalidArgumentException
     */
    protected function callSetter($name, $value)
    {
        if (method_exists(__CLASS__, $name)) {
            $this->{$name}($value);
        } else {
            throw new InvalidArgumentException("Invalid config key set!");
        }
    }

    /**
     * Converts snake_case to camelCase
     *
     * @param type $value
     * @return string
     * @throws NonStringTypeException
     */
    protected function snakeCaseToCamelCase($value)
    {
        if (is_string($value)) {
            $value = str_replace(' ', '', ucwords(str_replace('_', ' ', $value)));
            $value = strtolower(substr($value, 0, 1)) . substr($value, 1);
            return $value;
        } else {
            throw new NonStringTypeException($value);
        }
    }

    /**
     * Get Bitly OAuth Generic Access Token
     *
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * Set Bitly OAuth Generic Access Token
     *
     * @param type $accessToken
     * @return \Jelovac\Bitly4laravel\Model
     * @throws NonStringTypeException
     */
    public function setAccessToken($accessToken)
    {
        if (is_string($accessToken)) {
            $this->accessToken = $accessToken;
            return $this;
        } else {
            throw new NonStringTypeException($accessToken);
        }
    }

    /**
     * Get cache enabled
     *
     * @return bool
     */
    public function getCacheEnabled()
    {
        return $this->cacheEnabled;
    }

    /**
     * Set cache enabled
     *
     * @param bool $cacheEnabled
     * @return \Jelovac\Bitly4laravel\Model
     * @throws NonBooleanTypeException
     */
    public function setCacheEnabled($cacheEnabled)
    {
        if (is_bool($cacheEnabled)) {
            $this->cacheEnabled = $cacheEnabled;
            return $this;
        } else {
            throw new NonBooleanTypeException($cacheEnabled);
        }
    }

    /**
     * Get cache duration in minutes
     *
     * @return int
     */
    public function getCacheDuration()
    {
        return $this->cacheDuration;
    }

    /**
     * Set cache duration in minutes
     *
     * @param type $cacheDuration
     * @return \Jelovac\Bitly4laravel\Model
     * @throws NonIntegerTypeException
     */
    public function setCacheDuration($cacheDuration)
    {
        if (is_int($cacheDuration)) {
            $this->cacheDuration = $cacheDuration;
            return $this;
        } else {
            throw new NonIntegerTypeException($cacheDuration);
        }
    }

    /**
     * Get cache key prefix
     *
     * @return string
     */
    public function getCacheKeyPrefix()
    {
        return $this->cacheKeyPrefix;
    }

    /**
     * Set cache key prefix
     *
     * @param type $cacheKeyPrefix
     * @return \Jelovac\Bitly4laravel\Model
     * @throws NonStringTypeException
     */
    public function setCacheKeyPrefix($cacheKeyPrefix)
    {
        if (is_string($cacheKeyPrefix)) {
            $this->cacheKeyPrefix = $cacheKeyPrefix;
            return $this;
        } else {
            throw new NonStringTypeException($cacheKeyPrefix);
        }
    }

    /**
     * Get GuzzleHttp Client configuration
     *
     * @return array
     */
    public function getClientConfig()
    {
        return $this->clientConfig;
    }

    /**
     * Set GuzzleHttp Client configuration
     *
     * @param array $clientConfig
     * @return \Jelovac\Bitly4laravel\Model
     */
    public function setClientConfig(array $clientConfig)
    {
        $this->clientConfig = $clientConfig;
        return $this;
    }

    /**
     * Get Bitly API response format
     *
     * @return string
     */
    public function getResponseFormat()
    {
        return $this->responseFormat;
    }

    /**
     * Set Bitly API response format
     *
     * @param string $responseFormat
     * @return \Jelovac\Bitly4laravel\Model
     * @throws NonStringTypeException
     */
    public function setResponseFormat($responseFormat)
    {
        if (is_string($responseFormat)) {
            $this->responseFormat = $responseFormat;
            return $this;
        } else {
            throw new NonStringTypeException($responseFormat);
        }
    }

    /**
     * Get GuzzleHttp Client request options
     *
     * @return array
     */
    public function getRequestOptions()
    {
        return $this->requestOptions;
    }

    /**
     * Set GuzzleHttp Client request options
     *
     * @param array $requestOptions
     * @return \Jelovac\Bitly4laravel\Model
     */
    public function setRequestOptions(array $requestOptions)
    {
        $this->requestOptions = $requestOptions;
        return $this;
    }

    /**
     * Get request param
     *
     * @param mixed $key
     * @return mixed
     * @throws OutOfRangeException
     */
    public function getRequestParam($key)
    {
        if (array_key_exists($key, $this->requestParams)) {
            return $this->requestParams[$key];
        } else {
            throw new OutOfRangeException("Provided array key is out of range.");
        }
    }

    /**
     * Set request param
     *
     * @param type $key
     * @param type $value
     * @return \Jelovac\Bitly4laravel\Model
     */
    public function setRequestParam($key, $value)
    {
        $this->requestParams[$key] = $value;
        return $this;
    }

    /**
     * Get request params
     *
     * @return array
     */
    public function getRequestParams()
    {
        return $this->requestParams;
    }

    /**
     * Set request params
     *
     * @param array $requestParams
     * @return \Jelovac\Bitly4laravel\Model
     */
    public function setRequestParams(array $requestParams)
    {
        $this->requestParams = $requestParams;
        return $this;
    }

    /**
     * Get GuzzleHttp Client request type
     *
     * @return string
     */
    public function getRequestType()
    {
        return $this->requestType;
    }

    /**
     * Set GuzzleHttp Client request type
     *
     * @param string $requestType
     * @return \Jelovac\Bitly4laravel\Model
     * @throws NonStringTypeException
     */
    public function setRequestType($requestType)
    {
        if (is_string($requestType)) {
            $this->requestType = $requestType;
            return $this;
        } else {
            throw new NonStringTypeException($requestType);
        }
    }

}

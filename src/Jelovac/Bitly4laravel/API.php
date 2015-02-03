<?php namespace Jelovac\Bitly4laravel;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp;

class API {

    /**
     * Bit.ly API URL
     */
    const API_URL = "https://api-ssl.bitly.com";

    /**
     * Bit.ly API version
     */
    const API_VERSION = "v3";

    /**
     * Bitly4laravel configuration settings.
     *
     * @var array
     */
    protected $config = array();

    /**
     * Request params
     *
     * @var array
     */
    protected $requestParams = array();

    /**
     * Bitly4Laravel constructor.
     *
     * @param array $configuration
     */
    public function __construct(array $configuration = array())
    {
        $this->setConfigurationDefaults();
        $this->config = array_replace_recursive($this->config, $configuration);
    }

    /**
     * Set predefined configuration defaults.
     */
    protected function setConfigurationDefaults()
    {
        $this->config = array(
            "access_token" => null,
            "cache_enabled" => false,
            "cache_duration" => 3600, // Duration in minutes
            "cache_key_prefix" => "Bitly4Laravel.",
            "response_format" => "json", // json, xml
            "request_type" => "get", // get, post
            "request_options" => array(),
            "client_config" => array(),
        );
    }

    /**
     * Do the call ang get the response from Bitly API.
     *
     * @param string $action
     * @param array $params
     */
    public function get($action, array $params = array())
    {
        $this->requestParams['access_token'] = $this->config['access_token'];
        $this->requestParams['format'] = $this->config['response_format'];

        if (!empty($params)) {
            $this->requestParams = array_merge($params, $this->requestParams);
        }

        if ($this->config['cache_enabled']) {

            $cacheKey = $this->createCacheKey($action);

            // Check if the value is already cached
            if (Cache::has($cacheKey)) {
                return Cache::get($cacheKey);
            }
        }

        $response = $this->call($action, $this->requestParams);

        if ($this->config['cache_enabled']) {
            Cache::put($cacheKey, $response, $this->config['cache_duration']);
        }

        return $response;
    }

    /**
     * Execute the request and return the response.
     *
     * @param string $action
     * @param array $params
     * @return mixed
     */
    protected function call($action, array $params = array())
    {
        $url = static::API_URL . '/' . static::API_VERSION . '/' . $action;

        $client = new Client($this->config['client_config']);

        try {

            $options = array_merge(array('query' => $params), $this->config['request_options']);

            switch (strtolower($this->config['request_type'])) {

                case 'post':

                    $response = $client->post($url, $options);

                    break;

                case 'get':

                default:
                    $response = $client->get($url, $options);
            }

            switch (strtolower($this->config['response_format'])) {

                case 'xml':

                    $body = $response->xml();

                    break;

                case 'json':

                default:
                    $body = $response->json();
            }

            return $body;
        } catch (GuzzleHttp\Exception\BadResponseException $ex) {
            return $ex->getResponse()->getBody();
        }
    }

    /**
     * Create cache key.
     *
     * @param string $action
     * @return type
     */
    protected function createCacheKey($action)
    {
        $key = $this->config['cache_key_prefix'] . $action . json_encode($this->requestParams);
        return Hash::make($key);
    }

    /**
     * Set request parameter.
     *
     * @param string $key
     * @param mixed $value
     * @return \Jelovac\Bitly4laravel\Bitly4laravel
     */
    public function setRequestParam($key, $value)
    {
        $this->requestParams[$key] = $value;
        return $this;
    }

    /**
     * Set request parameters.
     *
     * @param array $params
     * @return \Jelovac\Bitly4laravel\API
     */
    public function setRequestParams(array $params)
    {
        $this->requestParams = array_replace_recursive($this->requestParams, $params);
        return $this;
    }

    /**
     * Set Bitly OAuth Generic Access Token.
     *
     * @param string $accessToken
     * @return \Jelovac\Bitly4laravel\Bitly4laravel
     */
    public function setAccessToken($accessToken)
    {
        $this->config['access_token'] = $accessToken;
        return $this;
    }

    /**
     * Set Bitly response format, can be either json or xml.
     *
     * @param string $format
     * @return \Jelovac\Bitly4laravel\Bitly4laravel
     */
    public function setResponseFormat($format)
    {
        $this->config['response_format'] = $format;
        return $this;
    }

    /**
     * Set request type, can be either get or post.
     *
     * @param string $type
     * @return \Jelovac\Bitly4laravel\API
     */
    public function setRequestType($type)
    {
        $this->config['request_type'] = $type;
        return $this;
    }

    /**
     * Set GuzzleHttp client request options.
     *
     * @param array $options
     * @return \Jelovac\Bitly4laravel\Bitly4laravel
     */
    public function setRequestOptions(array $options)
    {
        $this->config['request_options'] = array_replace_recursive($this->config['request_options'], $options);
        return $this;
    }

    /**
     * Set cache enabled.
     *
     * @param bool $true
     * @return \Jelovac\Bitly4laravel\Bitly4laravel
     */
    public function setCacheEnabled($true)
    {
        $this->config['cache_enabled'] = (bool) $true;
        return $this;
    }

    /**
     * Set cache duration in minutes.
     *
     * @param int $minutes
     * @return \Jelovac\Bitly4laravel\Bitly4laravel
     */
    public function setCacheDuration($minutes)
    {
        $this->config['cache_duration'] = (int) $minutes;
        return $this;
    }

    /**
     * Set cache key prefix.
     *
     * @param string $prefix
     * @return \Jelovac\Bitly4laravel\Bitly4laravel
     */
    public function setCacheKeyPrefix($prefix)
    {
        $this->config['cache_key_prefix'] = $prefix;
        return $this;
    }

    /**
     * Set GuzzleHttp Client configuration.
     *
     * @param array $config
     * @return \Jelovac\Bitly4laravel\API
     */
    public function setClientConfig(array $config)
    {
        $this->config['client_config'] = array_replace_recursive($this->config['client_config'], $config);
        return $this;
    }

    /**
     * Get request parameter value.
     *
     * @param string $key
     * @return type
     */
    public function getRequestParam($key)
    {
        return $this->requestParams[$key];
    }

    /**
     * Get request params.
     *
     * @return array
     */
    public function getRequestParams()
    {
        return $this->requestParams;
    }

    /**
     * Get Bitly OAuth Generic Access Token.
     *
     * @return string/null
     */
    public function getAccessToken()
    {
        return $this->config['access_token'];
    }

    /**
     * Get response format.
     *
     * @return string
     */
    public function getResponseFormat()
    {
        return $this->config['response_format'];
    }

    /**
     * Get request type.
     *
     * @return string
     */
    public function getRequestType()
    {
        return $this->config['request_type'];
    }

    /**
     * Get request options.
     *
     * @return array
     */
    public function getRequestOptions()
    {
        return $this->config['request_options'];
    }

    /**
     * Get is cache enabled
     *
     * @return bool
     */
    public function getCacheEnabled()
    {
        return $this->config['cache_enabled'];
    }

    /**
     * Get cache duration in minutes
     *
     * @return int
     */
    public function getCacheDuration()
    {
        return $this->config['cache_duration'];
    }

    /**
     * Get cache key prefix
     *
     * @return string
     */
    public function getCacheKeyPrefix()
    {
        return $this->config['cache_key_prefix'];
    }

    /**
     * Get GuzzleHttp Client configuration
     *
     * @return array
     */
    public function getClientConfig()
    {
        return $this->config['client_config'];
    }

}

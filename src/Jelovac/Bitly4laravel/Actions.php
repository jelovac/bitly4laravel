<?php

namespace Jelovac\Bitly4laravel;

class Actions {

    /**
     * Bitly API URL
     * @var string
     */
    const API_URL = "https://api-ssl.bitly.com/";

    /**
     * Storing bitly account parameters:
     * - client_id
     * - client_secret
     * - username
     * - password
     * - access_token
     * - api_key !deprecated
     * @var array 
     */
    private $accountParams = array();

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
    private $conn = array();

    /**
     * Storing various settings in an array
     * @var array
     */
    private $params = array(
        // values can be json, xml, array
        'format' => 'json',
        // API call type
        'call_type' => 'shorten',
        // Cache
        'use_cache' => false,
        // Cache key
        'cache_key' => 'Laravel.bitly.Class.Cache.',
        // Cache duration in minutes
        'cache_duration' => 3600
    );

    /**
     * Store cache object
     * @var mixed
     */
    private $cache = null;

    /**
     * Storing reponse data
     * @var mixed 
     */
    private $response = null;

    public function __construct(array $config)
    {
        $this->setAccountParams($config);
        $this->setParams($config);
    }

    /**
     * Fetch Bitly account parameters from config array
     * @param array $config
     */
    private function setAccountParams(array $config)
    {
        $keys = array('client_id', 'client_secret', 'access_token', 'username',
            'password', 'api_key');
        foreach ($keys as $key) {
            if (isset($config[$key])) {
                $this->accountParams[$key] = $config[$key];
            }
        }
    }

    /**
     * Fetch additional parameters from config array
     * @param array $config
     */
    private function setParams(array $config)
    {
        $keys = array('use_cache');
        foreach ($keys as $key) {
            if (isset($config[$key])) {
                $this->params[$key] = $config[$key];
            }
        }
    }

    private function doCall($url)
    {
        $url = static::API_URL . $url;

        if (count($this->params['post'])) {
            $url = $this->rebuildURL($url, $this->params['post']);
        }

        // Execute cURL call and retrieve response array
        $this->conn = Connection::make($url);


        if ($this->conn['error']['number'] == null || $this->conn['error']['number'] == 0) {
            $this->response = $this->convertConnectionToFormat($this->conn, $this->params['format']);
        } else {
            $message = $this->conn['error']['message'];
            $code = $this->conn['error']['number'];
            throw new Exception($message, $code);
        }

        return $this;
    }

    private function rebuildURL($url, array $params)
    {
        // Initiate query string
        $queryString = '';

        // loop parameters and add them to the queryString
        foreach ($params as $key => $value) {
            $queryString .= '&' . $key . '=' . urlencode(utf8_encode($value));
        }

        // Trim query string
        $queryString = trim($queryString, '&');

        // Append query string to URL
        $url .= '?' . $queryString;
        return $url;
    }

    private function convertConnectionToFormat(array $connection, $format)
    {
        switch ($format) {
            case 'json':
                $this->connectionToJSON($connection);
                break;
            case 'xml':
                $this->connectionToXML($connection);
                break;
            case 'array':
                $this->connectionToArray($connection);
                break;
            default :
                $this->connectionToJSON($connection);
        }
    }

    private function connectionToJSON(array $connection)
    {
        return json_decode($connection['response']['content']);
    }

    private function connectionToXML(array $connection)
    {
        return @simplexml_load_string($connection['response']['content']);
    }

    private function connectionToArray(array $connection)
    {
        return $this->simpleXMLToArray($this->connectionToXML($connection));
    }

    /**
     * @return array - Convert a SimpleXML object to an array so we
     * Could safely store it in the cache and retrieve it when needed.
     */
    private function simpleXMLToArray($xml)
    {
        if (get_class($xml) == 'SimpleXMLElement') {
            $attributes = $xml->attributes();
            foreach ($attributes as $k => $v) {
                if ($v)
                    $a[$k] = (string) $v;
            }
            $x = $xml;
            $xml = get_object_vars($xml);
        }
        if (is_array($xml)) {
            if (count($xml) == 0)
                return (string) $x;
            // for CDATA
            foreach ($xml as $key => $value) {
                $r[$key] = $this->simplexml2array($value);
            }
            if (isset($a))
                $r['@attributes'] = $a;
            // Attributes
            return $r;
        }
        return (string) $xml;
    }

    private function get($type = null, $login = null, $apiKey = null, $format = null)
    {
        if ($format !== null) {
            $this->params['format'] = $format;
        }

        if ($type !== null) {
            $this->params['call_type'] = $type;
        }

        if ($login !== null) {
            $this->accountParams['username'] = $login;
        }

        if ($apiKey !== null) {
            $this->accountParams['api_key'] = $apiKey;
        }

        $params = array(
            'login' => $this->accountParams['username'],
            'apiKey' => $this->accountParams['api_key'],
            'format' => $this->params['format']
        );

        if (is_array($this->params['post']) && count($this->params['post'])) {
            $this->params['post'] = array_merge($params, $this->params['post']);
        } else {
            $this->params['post'] = $params;
        }

        // If cache enabled, check if item is cached and return it
        if ($this->params['use_cache']) {
            $item = $this->getCachedItem();
            if ($item !== null || $item !== "") {
                $this->response = $item;
                return $this;
            }
        }

        // Make the call
        $this->doCall($this->params['call_type']);

        // If cache is enabled, save cache if needed
        if ($this->cache !== null) {
            $this->cacheItem();
        }

        return $this;
    }

    private function getCachedItem()
    {
        $key = $this->params['cache_key']
                . $this->params['call_type']
                . implode(':', $this->params['post']);
        return Cache::get($key);
    }

    private function cacheItem()
    {
        $key = $this->params['cache_key']
                . $this->params['call_type']
                . implode(':', $this->params['post']);
        Cache::put($key, $this->response, Carbon::now()->addMinutes($this->params['cache_duration']));
    }

    /**
     * Shorten URL callback
     * ---------------------
     * This functions is used to short a long url into a bit.ly short URL
     * @param string $uri - The long url needed to be shorten. You should use urlencode
     * In this case since bit.ly hates receiving urls with the characters such as ?, $, #
     * In it without being encoded.
     * @param string $login - this is used to override the default login set by the class
     * @param string $apiKey - this is used to override the default apiKey set by the class
     * @param string $format - this is set to be xml by default. bit.ly returns json by default
     * So you can either change this globally in the class property or locally when calling this method.
     * @return mixed - can be either XML as an array or XML, json string or a normal string depends on the format used.
     *
     * Usage:
     * ------
     * Bitly::shorten('http://www.betaworks.com')->getResponseData();
     *
     * Output:
     * -------
     * Array
     * (
     *   [status_code] => 200
     *   [status_txt] => OK
     *   [data] => Array
     *       (
     *           [url] => http://bit.ly/9PCy42
     *           [hash] => 9PCy42
     *           [global_hash] => 25iRBL
     *           [long_url] => http://www.betaworks.com
     *           [new_hash] => 0
     *       )
     *
     * )
     *
     *
     */
    public function shorten($uri = null, $login = null, $apiKey = null, $format = null)
    {
        $this->params['post']['longUrl'] = $uri;
        return $this->get('shorten', $login, $apiKey, $format);
    }

    /**
     * Expand URL callback
     * ---------------------
     * This functions is used to expand a short url that was created by bit.ly into it's original URL.
     * @param string $uri - The short url needed to be expanded. You should use urlencode
     * In this case since bit.ly hates receiving urls with the characters such as ?, $, #
     * In it without being encoded.
     * @param string $login - this is used to override the default login set by the class
     * @param string $apiKey - this is used to override the default apiKey set by the class
     * @param string $format - this is set to be xml by default. bit.ly returns json by default
     * So you can either change this globally in the class property or locally when calling this method.
     * @return mixed - can be either XML as an array or XML, json string or a normal string depends on the format used.
     *
     * Usage:
     * ------
     * Bitly::expand('http://bit.ly/1RmnUT')->getResponseData();
     *
     * Output:
     * -------
     * Array
     * (
     *   [status_code] => 200
     *   [status_txt] => OK
     *   [data] => Array
     *       (
     *           [entry] => Array
     *               (
     *                   [short_url] => http://bit.ly/1RmnUT
     *                   [long_url] => http://google.com
     *                   [user_hash] => 1RmnUT
     *                   [global_hash] => 1RmnUT
     *               )
     *
     *       )
     *
     * )
     *
     *
     */
    public function expand($uri = null, $login = null, $apiKey = null, $format = null)
    {
        $this->params['post']['shortUrl'] = $uri;
        return $this->get('expand', $login, $apiKey, $format);
    }

    /**
     * Validate callback
     * ---------------------
     * This functions is used to validate the given login name and apikey
     * @param string $xlogin - the login to be validated
     * @param string $xapi - the apiKey to be validated
     * @param string $login - this is used to override the default login set by the class
     * @param string $apiKey - this is used to override the default apiKey set by the class
     * @param string $format - this is set to be xml by default. bit.ly returns json by default
     * So you can either change this globally in the class property or locally when calling this method.
     * @return mixed - can be either XML as an array or XML, json string or a normal string depends on the format used.
     *
     * Usage:
     * ------
     * Bitly::validate('loginName', 'APIKEY')->getResponseData();
     *
     * Output:
     * -------
     * Array
     * (
     *  [status_code] => 200
     *   [status_txt] => OK
     *   [data] => Array
     *       (
     *           [valid] => 1
     *       )
     *
     * )
     *
     */
    public function validate($xlogin = null, $xapi = null, $login = null, $apiKey = null, $format = null)
    {
        $this->params['post']['x_login'] = $xlogin;
        $this->params['post']['x_apiKey'] = $xapi;
        return $this->get('validate', $login, $apiKey, $format);
    }

    /**
     * # Clicks callback
     * ---------------------
     * This functions is used to expand a short url that was created by bit.ly into it's original URL.
     * @param string $uri - The short url that we want to know the amount of clicks. You should use urlencode
     * In this case since bit.ly hates receiving urls with the characters such as ?, $, #
     * In it without being encoded.
     * @param string $login - this is used to override the default login set by the class
     * @param string $apiKey - this is used to override the default apiKey set by the class
     * @param string $format - this is set to be xml by default. bit.ly returns json by default
     * So you can either change this globally in the class property or locally when calling this method.
     * @return mixed - can be either XML as an array or XML, json string or a normal string depends on the format used.
     *
     * Usage:
     * ------
     * Bitly::clicks('http://bit.ly/1RmnUT')->getResponseData();
     *
     * Output:
     * -------
     * Array
     * (
     *  [status_code] => 200
     *  [data] => Array
     *       (
     *           [clicks] => Array
     *               (
     *                   [short_url] => http://bit.ly/1RmnUT
     *                   [global_hash] => 1RmnUT
     *                   [user_clicks] => 3508
     *                   [user_hash] => 1RmnUT
     *                   [global_clicks] => 3508
     *               )
     *
     *       )
     *
     *   [status_txt] => OK
     * )
     *
     *
     */
    public function clicks($uri = null, $login = null, $apiKey = null, $format = null)
    {
        $this->params['post']['shortUrl'] = $uri;
        return $this->get('clicks', $login, $apiKey, $format);
    }

    /**
     * Bitly.Pro callback
     * ---------------------
     * This is used to query whether a given short domain is assigned for bitly.Pro, and is consequently a valid shortUrl parameter for other api calls.
     * keep in mind that bitly.pro domains are restricted to less than 15 characters in length.
     * @param string $domain - A short domain (ie: nyti.ms).
     * @param string $login - this is used to override the default login set by the class
     * @param string $apiKey - this is used to override the default apiKey set by the class
     * @param string $format - this is set to be xml by default. bit.ly returns json by default
     * So you can either change this globally in the class property or locally when calling this method.
     * @return mixed - can be either XML as an array or XML, json string or a normal string depends on the format used.
     *
     * Usage:
     * ------
     * Bitly::bitly_pro_domain('nyti.ms')->getResponseData();
     *
     * Output:
     * -------
     * Array
     * (
     *  [status_code] => 200
     *   [data] => Array
     *       (
     *           [domain] => nyti.ms
     *           [bitly_pro_domain] => 1
     *       )
     *
     *   [status_txt] => OK
     * )
     */
    public function bitly_pro_domain($domain = null, $login = null, $apiKey = null, $format = null)
    {
        $this->params['post']['domain'] = $domain;
        return $this->get('bitly_pro_domain', $login, $apiKey, $format);
    }

}

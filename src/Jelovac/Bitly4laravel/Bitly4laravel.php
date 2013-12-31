<?php

namespace Jelovac\Bitly4laravel;

use Carbon,
    Cache,
    Log;

class Bitly4laravel {

    /**
     * @var API URL
     */
    const API_URL = 'http://api.bit.ly/v3/';

    /**
     * @var oAuth API URL
     */
    const OAUTH_URL = "https://api-ssl.bitly.com/";

    /**
     * @var oAuth Authorization URL
     */
    const OAUTH_AUTH_URL = "https://bitly.com/oauth/authorize";

    /**
     * @var oAuth API Port
     */
    const OAUTH_PORT = 443;

    /**
     * @var API Port
     */
    const API_PORT = 80;

    /**
     * @var Unique Identifier of the cached content
     */
    const CACHE_KEY = 'Laravel.bitly.Class.Cache.';

    /**
     * @var Login Name
     */
    public $login = null;

    /**
     * @var Login API Key
     */
    public $apiKey = null;

    /**
     *
     * @var oAuth Client ID
     */
    private $oAuthClientId = null;

    /**
     *
     * @var oAuth Client Secret
     */
    private $oAuthClientSecret = null;

    /**
     * @var oAuth Access Token 
     */
    private $oAuthAccessToken = null;

    /**
     * @var Default response format
     */
    public $format = 'json';

    /**
     * @var Default post params that will be attached to the request
     */
    public $postParams = array();

    /**
     * @var Enable or disable laravel cache.
     * The default cache mechanism set in app/config/cache.php will be used
     */
    public $useCache = false;

    /**
     * @var integer the time in minutes that the messages can remain valid in cache.
     * Defaults to 3600 minutes.
     */
    public $cachingDuration = 3600;

    /**
     * @var variable for storing cache result
     */
    private $cache = null;

    /**
     * @var Set true/false if you want to throw exceptions when error
     * Occurs. If you set this to false you can still know the error
     * Returned by accessing the methods getErrorNumber() and getErrorMessage()
     * And you can access the headers returned to see if there is an error there as well
     * By using the method getHeaders().
     */
    public $throwExceptions = false;

    /**
     * @var boolean - Set this property to true if you want to return the JSON response
     * As a PHP array instead of a JSON string. This is here just for the people who like to use JSON
     * Since the returned data will be much smaller and then use it in a PHP array fashion.
     */
    public $returnAsArray = false;

    /**
     * @var int - Timeout in seconds
     */
    public $timeOut = 10;

    /**
     * @var string - the default call to perform
     */
    public $apiCallType = 'shorten';

    /**
     * @var Allowd formats for the calls. Note that not all API calls allow each of those
     * Formats. Some support them all while others not.
     */
    protected $allowedFormats = array('xml', 'json', 'txt');

    /**
     * @var Returned response before being parsed
     */
    protected $response = array();

    /**
     * @var returned response after being parsed
     */
    protected $responseData = array();

    /**
     * @var The returned response headers array
     */
    protected $headers = array();

    /**
     * @var Error number if any. By default this is set to 0, meaning there is no error.
     */
    protected $errorNumber = 0;

    /**
     * @var Error message if any. By default this is empty, meaning there is no error.
     */
    protected $errorMessage = '';

    /**
     * Component initializer
     *
     * @throws Exception on missing CURL PHP Extension
     */
    public function __construct(array $config) {
        // Check if cURL extension is enabled
        if (!function_exists('curl_init')) {
            $message = "Sorry, But you need to have the CURL extension enabled in order to be able to use this class.";
            Log::critical($message);
            throw new Exception($message);
        } else {
            $this->apiKey = $config['apiKey'];
            $this->login = $config['login'];
            if (isset($config['use_cache'])) {
                $this->useCache = $config['use_cache'];
            }
            if (isset($config['cache_expires'])) {
                $this->cachingDuration = $config['cache_expires'];
            }
            if (isset($config['oauth_access_token'])) {
                $this->oAuthAccessToken = $config['oauth_access_token'];
            }
            if (isset($config['oauth_client_id'])) {
                $this->oAuthClientId = $config['oauth_client_id'];
            }
            if (isset($config['oauth_client_secret'])) {
                $this->oAuthClientSecret = $config['oauth_client_secret'];
            }
        }
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
    public function shorten($uri = null, $login = null, $apiKey = null, $format = null) {
        $this->postParams['longUrl'] = $uri;
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
    public function expand($uri = null, $login = null, $apiKey = null, $format = null) {
        $this->postParams['shortUrl'] = $uri;
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
    public function validate($xlogin = null, $xapi = null, $login = null, $apiKey = null, $format = null) {
        $this->postParams['x_login'] = $xlogin;
        $this->postParams['x_apiKey'] = $xapi;
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
    public function clicks($uri = null, $login = null, $apiKey = null, $format = null) {
        $this->postParams['shortUrl'] = $uri;
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
    public function bitly_pro_domain($domain = null, $login = null, $apiKey = null, $format = null) {
        $this->postParams['domain'] = $domain;
        return $this->get('bitly_pro_domain', $login, $apiKey, $format);
    }

    /**
     * This method is the one that runs the above callbacks.
     * @param string $type - the callback that needs to be called.
     * @param string $login - this is used to override the default login set by the class
     * @param string $apiKey - this is used to override the default apiKey set by the class
     * @param string $format - this is set to be xml by default. bit.ly returns json by default
     * So you can either change this globally in the class property or locally when calling this method.
     * @return mixed - can be either XML as an array or XML, json string or a normal string depends on the format used.
     */
    public function get($type = null, $login = null, $apiKey = null, $format = null) {

        if ($format !== null && in_array($format, $this->allowedFormats)) {
            $this->format = $format;
        }

        if ($type !== null) {
            $this->apiCallType = $type;
        }

        if ($login !== null) {
            $this->login = $login;
        }

        if ($apiKey !== null) {
            $this->apiKey = $apiKey;
        }

        $params = array('login' => $this->login,
            'apiKey' => $this->apiKey, 'format' => $this->format);

        if (is_array($this->postParams) && count($this->postParams)) {
            $this->postParams = array_merge($params, $this->postParams);
        } else {
            $this->postParams = $params;
        }

        // Check if cache is enabled and get cache
        if ($this->useCache !== false) {
            $this->getCachedItem();
        }

        // Make the call
        $this->doCall($this->apiCallType);

        // We store it in the cache if we need to
        if (isset($this->cache) && $this->cache !== null) {
            $key = self::CACHE_KEY . $this->apiCallType . implode(':', $this->postParams);
            Cache::put($key, $this->getResponseData(), Carbon::now()->addMinutes($this->cachingDuration));
        }

        return $this;
    }

    private function oAuthAuthorize() {
        $url = self::OAUTH_AUTH_URL . "?" . "client_id=" . $this->oAuthClientId
                . "&amp;" . "client_secret=" . $this->oAuthClientSecret
                . "&amp;" . "redirect_uri=" . $this->oAuthRedirectURL;
        $this->executeCURL(urlencode(utf8_encode($url)), self::OAUTH_PORT);
        $this->responseData = json_decode($this->response);
        $code = $this->responseData->{'code'};
        $url = self::OAUTH_AUTH_URL . "?" . "client_id=" . $this->oAuthClientId
                . "&amp;" . "client_secret=" . $this->oAuthClientSecret
                . "&amp;" . "code=" . $code
                . "&amp;" . "redirect_uri=" . $this->oAuthRedirectURL;
        $this->executeCURL(urlencode(utf8_encode($url)), self::OAUTH_PORT);
        $this->responseData = json_decode($this->response);
        $this->oAuthAccessToken = $this->responseData->{'access_token'};
        $this->login = $this->responseData->{'login'};
        $this->apiKey = $this->responseData->{'apiKey'};
    }

    private function executeCURL($url, $port) {
        // Initiate cURL
        $curl = curl_init();

        // Set parameters
        $options[CURLOPT_URL] = $url;
        $options[CURLOPT_PORT] = $port;
        $options[CURLOPT_FOLLOWLOCATION] = true;
        $options[CURLOPT_RETURNTRANSFER] = true;
        $options[CURLOPT_TIMEOUT] = $this->timeOut;

        
        // Execute
        $this->response = curl_exec($curl);
        $this->headers = curl_getinfo($curl);

        // Fetch Errors
        $this->errorNumber = curl_errno($curl);
        $this->errorMessage = curl_error($curl);

        curl_close($curl);
    }

    /**
     *
     * @param string - The API Call to load
     * @throws CException if the property throwExceptions evaluates to true
     * @return $this object reference
     */
    protected function doCall($url, $oAuth = false) {

        // build url
        $url = self::API_URL . $url;

        if ($oAuth !== false) {
            
        }

        // rebuild url if we don't use post
        if (count($this->postParams)) {
            // init var
            $queryString = '';

            // loop parameters and add them to the queryString
            foreach ($this->postParams as $key => $value) {
                $queryString .= '&' . $key . '=' . urlencode(utf8_encode($value));
            }

            // cleanup querystring
            $queryString = trim($queryString, '&');

            // append to url
            $url .= '?' . $queryString;
        }

        // set options
        $options[CURLOPT_URL] = $url;
        $options[CURLOPT_PORT] = self::API_PORT;
        $options[CURLOPT_FOLLOWLOCATION] = true;
        $options[CURLOPT_RETURNTRANSFER] = true;
        $options[CURLOPT_TIMEOUT] = $this->timeOut;

        // init
        $curl = curl_init();

        // set options
        curl_setopt_array($curl, $options);

        // execute
        $this->response = curl_exec($curl);
        $this->headers = curl_getinfo($curl);

        // fetch errors
        $this->errorNumber = curl_errno($curl);
        $this->errorMessage = curl_error($curl);

        // close
        curl_close($curl);

        // validate body
        if ($this->format == 'xml') {
            // need to check why author surpressed warnings?!
            $xml = @simplexml_load_string($this->response);
            if (($xml !== false && isset($xml->error)) && $this->throwExceptions) {
                throw new Exception($xml->error);
            }

            $this->setResponseData($this->simplexml2array($xml));
        } else if (($this->format == 'json') && ($this->returnAsArray)) {
            $this->setResponseData(json_decode($this->response));
        } else {
            $this->setResponseData($this->response);
        }
        // invalid headers
        if (!in_array($this->headers['http_code'], array(0, 200))) {
            // throw error
            if ($this->throwExceptions) {
                throw new Exception($this->headers['http_code']);
            }
        }

        // error?
        if (($this->errorNumber != '') && ($this->throwExceptions)) {
            throw new Exception($this->errorMessage, $this->errorNumber);
        }

        // return
        return $this;
    }

    /**
     * Set the response data property
     *
     * @param mixed - the data to store in the responseData property
     * @return void
     */
    public function setResponseData($data) {
        $this->responseData = $data;
    }

    /**
     * @return mixed - Return the default CURL response
     */
    public function getResponse() {
        return $this->response;
    }

    /**
     * @return mixed - Return the response code after being parsed
     */
    public function getResponseData() {
        return $this->responseData;
    }

    /**
     * @return array - Return the CURL HTTP headers
     */
    public function getHeaders() {
        return $this->headers;
    }

    /**
     * @return int - If error occurs while performing the CURL
     * Request then the error code will be retrieved by this method
     */
    public function getErrorNumber() {
        return $this->errorNumber;
    }

    /**
     * @return string - If error occurs while performing the CURL
     * Request then the error code will be retrieved by this method
     */
    public function getErrorMessage() {
        return $this->errorMessage;
    }

    /**
     * Get cached item from Laravels cache 
     */
    public function getCachedItem() {
        $this->cache = Cache::get($this->useCache);
        if ($this->cache !== null) {
            $data = $this->cache->get(self::CACHE_KEY . $this->apiCallType . implode(':', $this->postParams));
            if ($data !== false) {
                $this->setResponseData($data);
                return $this;
            }
        }
    }

    /**
     * @return array - Convert a SimpleXML object to an array so we
     * Could safely store it in the cache and retrieve it when needed.
     */
    protected function simplexml2array($xml) {
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

}

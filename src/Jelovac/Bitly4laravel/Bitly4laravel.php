<?php

namespace Jelovac\Bitly4laravel;

class Bitly4laravel extends CallbackEngine {

    public function __construct(array $config)
    {
        parent::__construct($config);
    }

    /**
     * Shorten URL callback
     * ---------------------
     * This functions is used to short a long url into a bit.ly short URL
     * @param string $uri - The long url needed to be shorten. You should use urlencode
     * In this case since bit.ly hates receiving urls with the characters such as ?, $, #
     * In it without being encoded.
     * @param string $accessToken - Generic oAuth Access Token
     * Can be aquired at Bitly site, or fetched using oAuth web flow (experimental)
     * @param string $format - this is set to be xml by default. bit.ly returns json by default
     * So you can either change this globally in the class property or locally when calling this method.
     * @param string $output
     * $output = "object" returns format as object
     * $output = "array" returns format as associative array
     * $output = "string" returns format
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
    public function shorten($uri = null, $accessToken = null, $format = null, $output = null)
    {
        $this->postParams['longUrl'] = $uri;
        return $this->get('shorten', $accessToken, $format, $output);
    }

    /**
     * Expand URL callback
     * ---------------------
     * This functions is used to expand a short url that was created by bit.ly into it's original URL.
     * @param string $uri - The short url needed to be expanded. You should use urlencode
     * In this case since bit.ly hates receiving urls with the characters such as ?, $, #
     * In it without being encoded.
     * @param string $accessToken - Generic oAuth Access Token
     * Can be aquired at Bitly site, or fetched using oAuth web flow (experimental)
     * @param string $format - this is set to be xml by default. bit.ly returns json by default
     * So you can either change this globally in the class property or locally when calling this method.
     * @param string $output
     * $output = "object" returns format as object
     * $output = "array" returns format as associative array
     * $output = "string" returns format
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
    public function expand($uri = null, $accessToken = null, $format = null, $output = null)
    {
        $this->postParams['shortUrl'] = $uri;
        return $this->get('expand', $accessToken, $format, $output);
    }

    /**
     * Validate callback
     * ---------------------
     * This functions is used to validate the given login name and apikey
     * @param string $xlogin - the login to be validated
     * @param string $xapi - the apiKey to be validated
     * @param string $accessToken - Generic oAuth Access Token
     * Can be aquired at Bitly site, or fetched using oAuth web flow (experimental)
     * @param string $format - this is set to be xml by default. bit.ly returns json by default
     * So you can either change this globally in the class property or locally when calling this method.
     * @param string $output
     * $output = "object" returns format as object
     * $output = "array" returns format as associative array
     * $output = "string" returns format
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
    public function validate($xlogin = null, $xapi = null, $accessToken = null, $format = null, $output = null)
    {
        $this->postParams['x_login'] = $xlogin;
        $this->postParams['x_apiKey'] = $xapi;
        return $this->get('validate', $accessToken, $format, $output);
    }

    /**
     * # Clicks callback
     * ---------------------
     * This functions is used to expand a short url that was created by bit.ly into it's original URL.
     * @param string $uri - The short url that we want to know the amount of clicks. You should use urlencode
     * In this case since bit.ly hates receiving urls with the characters such as ?, $, #
     * In it without being encoded.
     * @param string $accessToken - Generic oAuth Access Token
     * Can be aquired at Bitly site, or fetched using oAuth web flow (experimental)
     * @param string $format - this is set to be xml by default. bit.ly returns json by default
     * So you can either change this globally in the class property or locally when calling this method.
     * @param string $output
     * $output = "object" returns format as object
     * $output = "array" returns format as associative array
     * $output = "string" returns format
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
    public function clicks($uri = null, $accessToken = null, $format = null, $output = null)
    {
        $this->postParams['shortUrl'] = $uri;
        return $this->get('clicks', $accessToken, $format, $output);
    }

    /**
     * Bitly.Pro callback
     * ---------------------
     * This is used to query whether a given short domain is assigned for bitly.Pro, and is consequently a valid shortUrl parameter for other api calls.
     * keep in mind that bitly.pro domains are restricted to less than 15 characters in length.
     * @param string $domain - A short domain (ie: nyti.ms).
     * @param string $accessToken - Generic oAuth Access Token
     * Can be aquired at Bitly site, or fetched using oAuth web flow (experimental)
     * @param string $format - this is set to be xml by default. bit.ly returns json by default
     * So you can either change this globally in the class property or locally when calling this method.
     * @param string $output
     * $output = "object" returns format as object
     * $output = "array" returns format as associative array
     * $output = "string" returns format
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
    public function bitly_pro_domain($domain = null, $accessToken = null, $format = null, $output = null)
    {
        $this->postParams['domain'] = $domain;
        return $this->get('bitly_pro_domain', $accessToken, $format, $output);
    }

}
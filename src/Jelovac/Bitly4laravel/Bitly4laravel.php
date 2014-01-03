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
     * @param string $login - this is used to override the default login set by the class
     * @param string $apiKey - this is used to override the default apiKey set by the class
     * @param string $format - this is set to be xml by default. bit.ly returns json by default
     * So you can either change this globally in the class property or locally when calling this method.
     * @param boolean $output - if true returns array or object depending on format
     * if false returns json or xml string
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
    public function shorten($uri = null, $login = null, $apiKey = null, $format = null, $output = null)
    {
        $this->postParams['longUrl'] = $uri;
        return $this->get('shorten', $login, $apiKey, $format, $output);
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
     * @param boolean $output - if true returns array or object depending on format
     * if false returns json or xml string
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
    public function expand($uri = null, $login = null, $apiKey = null, $format = null, $output = null)
    {
        $this->postParams['shortUrl'] = $uri;
        return $this->get('expand', $login, $apiKey, $format, $output);
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
     * @param boolean $output - if true returns array or object depending on format
     * if false returns json or xml string
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
    public function validate($xlogin = null, $xapi = null, $login = null, $apiKey = null, $format = null, $output = null)
    {
        $this->postParams['x_login'] = $xlogin;
        $this->postParams['x_apiKey'] = $xapi;
        return $this->get('validate', $login, $apiKey, $format, $output);
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
     * @param boolean $output - if true returns array or object depending on format
     * if false returns json or xml string
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
    public function clicks($uri = null, $login = null, $apiKey = null, $format = null, $output = null)
    {
        $this->postParams['shortUrl'] = $uri;
        return $this->get('clicks', $login, $apiKey, $format, $output);
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
     * @param boolean $output - if true returns array or object depending on format
     * if false returns json or xml string
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
    public function bitly_pro_domain($domain = null, $login = null, $apiKey = null, $format = null, $output = null)
    {
        $this->postParams['domain'] = $domain;
        return $this->get('bitly_pro_domain', $login, $apiKey, $format, $output);
    }

}
<?php namespace Jelovac\Bitly4laravel;

use \Illuminate\Support\Facades\Cache;
use \GuzzleHttp\Client;
use \GuzzleHttp\Exception\BadResponseException;

class API extends Model {

    /**
     * Make the call and get the response from Bitly API
     *
     * @param string $action
     * @param array $params
     */
    public function make($action, array $params = array())
    {
        $this->requestParams['access_token'] = $this->accessToken;
        $this->requestParams['format'] = $this->responseFormat;

        if (!empty($params)) {
            $this->requestParams = array_merge($this->requestParams , $params);
        }

        if ($this->cacheEnabled) {

            $cacheKey = $this->createCacheKey($action);

            // Check if the value is already cached
            if (Cache::has($cacheKey)) {
                return Cache::get($cacheKey);
            }
        }

        $response = $this->call($action, $this->requestParams);

        if ($this->cacheEnabled) {
            Cache::put($cacheKey, $response, $this->cacheDuration);
        }

        return $response;
    }

    /**
     * Execute the request and return the response
     *
     * @param string $action
     * @param array $params
     * @return mixed
     */
    protected function call($action, array $params = array())
    {
        $url = static::API_URL . '/' . static::API_VERSION . '/' . $action;

        $client = new Client($this->clientConfig);

        try {

            $options = array_merge(array('query' => $params), $this->requestOptions);

            switch (strtolower($this->requestType)) {

                case 'post':

                    $response = $client->post($url, $options);

                    break;

                case 'get':

                default:
                    $response = $client->get($url, $options);
            }

            switch (strtolower($this->responseFormat)) {

                case 'xml':

                    $body = $response->xml();

                    break;

                case 'json':

                default:
                    $body = json_decode($response->getBody());
            }

            return $body;
        } catch (BadResponseException $ex) {
            return $ex->getResponse()->getBody();
        }
    }

    /**
     * Create cache key
     *
     * @param string $action
     * @return type
     */
    protected function createCacheKey($action)
    {
        $key = $this->cacheKeyPrefix . $action . json_encode($this->requestParams);
        return sha1($key);
    }

}

<?php

namespace Jelovac\Bitly4laravel;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp;

class API extends Model
{

    public function get($action)
    {
        if ($this->useCache) {
            $cacheKey = $this->createCacheKey($action);
            // Check if the value is already cached
            if (Cache::has($cacheKey)) {
                return Cache::get($cacheKey);
            }
        }

        $this->requestParams['access_token'] = $this->getAccessToken();
        $this->requestParams['format'] = $this->responseFormat;

        $response = $this->doCall($action, $this->requestParams);

        if ($this->getUseCache()) {
            Cache::put($cacheKey, $response, $this->cacheDuration);
        }

        return $response;
    }

    /**
     * Make a connection and return response data
     * @param string $action
     * @param array $params
     * @return type
     */
    protected function doCall($action, array $params)
    {
        $url = self::$apiURL . self::$apiVersion . $action;
        $client = new GuzzleHttp\Client($this->clientConfig);

        try {

            $options = array_merge(array('query' => $params), $this->requestOptions);

            switch (strtolower($this->requestType)) {
                case "post":
                    $response = $client->post($url, $options);
                    break;
                default:
                    $response = $client->get($url, $options);
            }

            switch (strtolower($this->responseFormat)) {
                case "xml":
                    $body = $response->xml();
                    break;
                default:
                    $body = $response->json();
            }

            return $body;
        } catch (GuzzleHttp\Exception\BadResponseException $ex) {
            return $ex->getResponse()->getBody();
        }
    }

    /**
     * Create unique cache key
     * @param string $type
     * @return string
     */
    protected function createCacheKey($type)
    {
        $key = $this->cacheKey . $type . json_encode($this->requestParams);
        return Hash::make($key);
    }

}

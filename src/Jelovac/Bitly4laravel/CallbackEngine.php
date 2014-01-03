<?php

namespace Jelovac\Bitly4laravel;

Use Carbon\Carbon as Carbon;
use Illuminate\Support\Facades\Cache;

class CallbackEngine {

    /**
     * Bitly API URL
     * @var string
     */
    private static $apiURL = "https://api-ssl.bitly.com/";

    /**
     * Storing post parameters
     * @var array 
     */
    protected $postParams = array();

    /**
     * Model
     * @var class 
     */
    private $model = null;

    /**
     * Constructor
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->model = new Model($config);
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
    public function get($type = null, $login = null, $apiKey = null, $format = null)
    {
        if ($format !== null) {
            $this->model->setFormat($format);
        }

        if ($type !== null) {
            $this->model->setCallType($type);
        }

        if ($login !== null) {
            $this->model->setUsername($login);
        }

        if ($apiKey !== null) {
            $this->model->setApiKey($apiKey);
        }

        $params = array(
            'login' => $this->model->getUsername(),
            'apiKey' => $this->model->getApiKey(),
            'format' => $this->model->getFormat()
        );

        if (count($this->postParams)) {
            $this->postParams = array_merge($params, $this->postParams);
        } else {
            $this->postParams = $params;
        }

        // If cache enabled, check if item is cached and return it
        if ($this->model->getUseCache()) {
            $item = $this->getCachedItem();
            if ($item !== null || $item !== "") {
                $this->model->setResponseData($item);
                return $this;
            }
        }

        // Make the call
        $this->doCall($this->model->getCallType());

        // If cache is enabled, save cache if needed
        if ($this->model->getCache() !== null) {
            $this->cacheItem();
        }

        return $this;
    }

    public function getResponseData()
    {
        return $this->model->getResponseData();
    }

    private function doCall($url)
    {
        $url = static::$apiURL . $url;

        if (count($this->params['post'])) {
            $url = Helper::rebuildURL($url, $this->params['post']);
        }

        // Execute cURL call and retrieve response array
        $this->response = Connection::make($url);

        if ($this->response['error']['number'] == 0) {
            $data = $this->convertConnectionToFormat($this->response, $this->params['format']);
            $this->model->setResponseData($data);
        } else {
            $message = $this->response['error']['message'];
            $code = $this->response['error']['number'];
            throw new Exception($message, $code);
        }

        return $this;
    }

    private function convertConnectionToFormat(array $response, $format)
    {
        switch ($format) {
            case 'json':
                return Helper::responseToJSON($response);
            case 'xml':
                return Helper::responseToXML($response);
            case 'array':
                return Helper::responseToArray($response);
            default :
                return Helper::responseToJSON($response);
        }
    }

    private function getCachedItem()
    {
        $key = $this->model->getCacheKey()
                . $this->model->getCallType()
                . implode(':', $this->postParams);
        return Cache::get($key);
    }

    private function cacheItem()
    {
        $key = $this->model->getCacheKey()
                . $this->model->getCallType()
                . implode(':', $this->postParams);
        Cache::put($key, $this->model->getResponseData(), Carbon::now()->addMinutes($this->model->getCacheDuration()));
    }

}
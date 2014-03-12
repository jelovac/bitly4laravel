<?php namespace Jelovac\Bitly4laravel;

use Carbon\Carbon as Carbon;
use Illuminate\Support\Facades\Cache;
use Exception;

class CallbackEngine {

    /**
     * Bitly API URL
     * @var string
     */
    public static $apiURL = "https://api-ssl.bitly.com/";

    /**
     * Bitly api version to use
     * @var string 
     */
    public static $apiVersion = "v3/";

    /**
     * Storing post parameters
     * @var array 
     */
    protected $postParams = array();

    /**
     * Model
     * @var class 
     */
    protected $model = null;

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
     * @param string $accessToken - Generic oAuth AccessToken which can be aquired from Bitly site
     * @param string $format - this is set to be xml by default. bit.ly returns json by default
     * So you can either change this globally in the class property or locally when calling this method.
     * @return mixed - can be either XML as an array or XML, json string or a normal string depends on the format used.
     */
    public function get($type = null)
    {

        if ($type !== null) {
            $this->model->setCallType($type);
        }

        $params = array();

        $params['access_token'] = $this->model->getAccessToken();
        $params['format'] = $this->model->getFormat();

        if (count($this->postParams)) {
            $this->postParams = array_merge($params, $this->postParams);
        } else {
            $this->postParams = $params;
        }

        // If cache enabled, check if item is cached and return it
        if ($this->model->getUseCache()) {
            $item = $this->getCachedItem();
            if (!empty($item)) {
                $this->model->setResponseData($item);
                return $this;
            }
        }

        // Make the call
        $this->doCall($this->model->getCallType());

        // If cache is enabled, save cache if needed
        if ($this->model->getUseCache()) {
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
        $url = self::$apiURL . self::$apiVersion . $url;

        $options = array();

        if ($this->model->getPostRequest()) {

            $options[CURLOPT_POST] = true;
            $options[CURLOPT_POSTFIELDS] = $this->postParams;
        } else {

            if (count($this->postParams)) {
                $url = $this->rebuildURL($url, $this->postParams);
            }
        }

        // Execute cURL call and retrieve response array
        $this->model->setResponse(Connection::make($url, $options));

        if ($this->model->response['error']['number'] == 0) {
            $data = $this->convertResponseToFormat($this->model->response, $this->model->getFormat());
            $this->model->setResponseData($data);
        } else {
            $message = $this->model->response['error']['message'];
            $code = $this->model->response['error']['number'];
            throw new Exception($message, $code);
        }

        return $this;
    }

    private function convertResponseToFormat(array $response, $format)
    {
        switch ($format) {
            case 'json':

                switch ($this->model->getVariableOutput()) {
                    case 'object':
                        return $this->decodeJSONRespone($response);
                    case 'array':
                        return $this->decodeJSONRespone($response, true);
                    default:
                        return $response['response']['content'];
                }

            case 'xml':

                switch ($this->model->getVariableOutput()) {
                    case 'object':
                        return simplexml_load_string($response['response']['content']);
                    case 'array':
                        return $this->convertXMLResponeToArray($response);
                    default:
                        return $response['response']['content'];
                }

            default:
                return $response['response']['content'];
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

    protected function rebuildURL($url, array $params)
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

    private function decodeJSONRespone(array $response, $toArray = false)
    {
        return json_decode($response['response']['content'], $toArray);
    }

    private function convertXMLResponeToArray(array $response)
    {
        $xml = simplexml_load_string($response['response']['content'], 'SimpleXMLElement');
        return $this->simpleXMLToArray($xml);
    }

    /**
     * @return array - Convert a SimpleXML object to an array so we
     * Could safely store it in the cache and retrieve it when needed.
     */
    private function simpleXMLToArray($xml)
    {
        if (is_object($xml)) {
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
                    if (is_object($value)) {
                        $r[$key] = $this->simpleXMLToArray($value);
                    } else {
                        $r[$key] = $value;
                    }
                }
                if (isset($a))
                    $r['@attributes'] = $a;
                // Attributes
                return $r;
            }
        }
        return (string) $xml;
    }

    protected function clearPostData()
    {
        $this->postParams = array();
    }

    protected function getPostData()
    {
        return $this->postParams;
    }

    protected function removePostData($key)
    {
        unset($this->postParams[$key]);
    }

    protected function setPostData($key, $value)
    {
        if ($value !== null) {
            $this->postParams[$key] = $value;
        }
    }

}
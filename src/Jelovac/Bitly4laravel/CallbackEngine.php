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
    public function get($type = null, $login = null, $apiKey = null, $format = null, $output = null)
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

        if ($output !== null && is_bool($output)) {
            $this->model->setVariableOutput($output);
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
        $url = self::$apiURL . $url;

        if (count($this->postParams)) {
            $url = $this->rebuildURL($url, $this->postParams);
        }

        // Execute cURL call and retrieve response array
        $this->model->setResponse(Connection::make($url));

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

}
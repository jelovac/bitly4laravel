<?php

namespace Jelovac\Bitly4laravel;

class Helper {

    public static function rebuildURL($url, array $params)
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
    
    public static function responseToJSON(array $response)
    {
        return json_decode($response['response']['content']);
    }

    public static function responseToXML(array $response)
    {
        return @simplexml_load_string($response['response']['content']);
    }

    public static function responseToArray(array $response)
    {
        return $this->simpleXMLToArray($this->responseToXML($response));
    }

    /**
     * @return array - Convert a SimpleXML object to an array so we
     * Could safely store it in the cache and retrieve it when needed.
     */
    public static function simpleXMLToArray($xml)
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
    
}
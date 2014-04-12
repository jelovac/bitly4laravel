<?php

use Jelovac\Bitly4laravel\Connection;

class ConnectionTest extends PHPUnit_Framework_TestCase
{

    /**
     * Retrieving date and time from http://date.jsontest.com/
     * @var string  
     */
    private $url = "http://date.jsontest.com/";

    /**
     * Setting default curl port
     * @var array 
     */
    private $options = array(CURLOPT_PORT => 80);

    public function testPassResponse()
    {
        // Executing the connection
        $result = Connection::make($this->url, $this->options);
        // var dumping the result in the terminal
        // print_r(var_dump($result));
        // Cheking if response code returned 200
        $this->assertEquals(200, $result['response']['headers']['http_code']);
    }

    public function testFailtResponse()
    {
        // Executing the connection
        $result = Connection::make('', $this->options);
        // var dumping the result in the terminal
        // print_r(var_dump($result));
        // Cheking if response code returned 200
        $this->assertNotEquals(200, $result['response']['headers']['http_code']);
    }

    public function testFailtResponse2()
    {
        // Executing the connection
        $result = Connection::make('', $this->options);
        // var dumping the result in the terminal
        // print_r(var_dump($result));
        // Cheking if response code returned 200
        $this->assertNotEquals(200, $result['response']['headers']['http_code']);
    }

    public function testSelfSignedCertificate()
    {
        $url = "https://onlinessl.netlock.hu/en/test-center/self-signed-ssl-certificate.html";
        $options = array(CURLOPT_PORT => 443, CURLOPT_SSL_VERIFYHOST => 0, CURLOPT_SSL_VERIFYPEER => 0);
        $result = Connection::make($url, $options);
        $this->assertEquals(200, $result['response']['headers']['http_code']);
    }

}

<?php

use Jelovac\Bitly4laravel\Bitly4laravel;

class Bittly4laravelTest extends PHPUnit_Framework_TestCase
{
    
    public function testSelfSignedCertificateSuccessful()
    {
        // cURL options
        $options = array(CURLOPT_PORT => 443, CURLOPT_SSL_VERIFYHOST => 0, CURLOPT_SSL_VERIFYPEER => 0);
        // oAuth Generic Access Token
        $accessToken = "token";
        // Load our package
        $package = new Bitly4laravel(array('connection_options' => $options));
        // Call the expand method
        $result = $package->setAccessToken($accessToken)->shorten("https://github.com/jelovac/bitly4laravel")->getResponseData();
        // Print the result
        print_r(var_dump($result));
        // Successfull connection to api despite the wrong token, which means that cURL works.
        $this->assertEquals(500, $result['status_code']);
    }
    
}

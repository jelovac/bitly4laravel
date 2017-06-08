<?php namespace Jelovac\Bitly4laravel\Tests;

use \PHPUnit_Framework_TestCase;

class Bitly4laravelTest extends PHPUnit_Framework_TestCase
{

    /**
     * Tests if provided short URL is valid URL
     */
    public function testProvidedShortUrlIsValidUrl()
    {
        $condition = filter_var('http://bit.ly/1nnxQND', FILTER_VALIDATE_URL) !== false;
        $this->assertTrue($condition);
    }

    /**
     * Tests if provided hash string is not valid URL
     */
    public function testProvidedHashStringIsNotValidUrl()
    {
        $condition = filter_var('1nnxQND', FILTER_VALIDATE_URL) !== false;
        $this->assertFalse($condition);
    }

}

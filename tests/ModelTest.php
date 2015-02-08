<?php namespace Jelovac\Bitly4laravel\Tests;

use \Jelovac\Bitly4laravel\Model;

class ModelTest extends \PHPUnit_Framework_TestCase {

    protected $model;

    protected function setUp()
    {
        $this->model = new Model;
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetConfigThrowsInvalidArgumentException()
    {
        $this->model->setConfig(array(
            'invalid_key' => 1,
        ));
    }

    public function testSetAccessTokenSuccess()
    {
        $this->model->setAccessToken("1");
        $this->assertEquals("1", $this->model->getAccessToken());
    }

    /**
     * @expectedException \Jelovac\Bitly4laravel\Exceptions\Type\NonStringTypeException
     */
    public function testSetAccessTokenThrowsNonStringTypeException()
    {
        $this->model->setAccessToken(1);
    }

    public function testGetRequestParamSuccess()
    {
        $requestParam = "https://github.com/jelovac/bitly4laravel";
        $this->model->setRequestParam('longUrl', $requestParam);
        $this->assertEquals($requestParam, $this->model->getRequestParam('longUrl'));
    }

    /**
     * @expectedException \OutOfRangeException
     */
    public function testGetRequestParamThrowsOutOfRangeException()
    {
        $model = new Model;
        $model->getRequestParam('longUrl');
    }

}

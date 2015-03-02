<?php namespace Jelovac\Bitly4laravel\Exceptions;

/**
 * Exception thrown if an argument is not Integer type.
 */
class NonIntegerTypeException extends InvalidTypeException {

    /**
     * Throwing non Integer type exception
     *
     * @param any $var
     */
    public function __construct($var)
    {
        $message = $this->assembleMessage($var, 'Integer');
        parent::__construct($message);
    }

}

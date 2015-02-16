<?php namespace Jelovac\Bitly4laravel\Exceptions\Type;

/**
 * Exception thrown if an argument is not Boolean type.
 */
class NonBooleanTypeException extends InvalidTypeException {

    /**
     * Throwing nonBboolean type exception
     *
     * @param any $var
     */
    public function __construct($var)
    {
        $message = $this->assembleMessage($var, 'Boolean');
        parent::__construct($message);
    }

}

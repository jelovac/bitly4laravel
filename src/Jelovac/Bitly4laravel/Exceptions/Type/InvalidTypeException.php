<?php namespace Jelovac\Bitly4laravel\Exceptions\Type;

use \InvalidArgumentException;

abstract class InvalidTypeException extends InvalidArgumentException {

    /**
     * Assemble exception message
     *
     * @param any $var
     * @param any $expectedType
     * @return string
     */
    protected function assembleMessage($var, $expectedType)
    {

        $type = ucfirst(gettype($var));

        $message = "Invalid variable type detected! "
                . "The variable must be type \"{$expectedType}\", \"{$type}\" type passed.";

        return $message;
    }

}

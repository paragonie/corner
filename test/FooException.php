<?php
namespace ParagonIE\Corner\Tests;

use ParagonIE\Corner\Exception;

/**
 * Class FooException
 * @package ParagonIE\Corner\Tests
 */
class FooException extends Exception
{
    public function __construct($message = "", $code = 0, $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->helpfulMessage = "This is an example of the Exception class";
        $this->supportLink = "https://github.com/paragonie/corner";
    }
}

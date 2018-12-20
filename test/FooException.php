<?php
declare(strict_types=1);
namespace ParagonIE\Corner\Tests;

use ParagonIE\Corner\Exception;

/**
 * Class FooException
 * @package ParagonIE\Corner\Tests
 */
class FooException extends Exception
{
    public function __construct(string $message = "", int $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->helpfulMessage = "This is an example of the Exception class";
        $this->supportLink = "https://github.com/paragonie/corner";
    }
}

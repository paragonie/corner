<?php
declare(strict_types=1);
namespace ParagonIE\Corner\Tests;

use ParagonIE\Corner\Error;

/**
 * Class FooError
 * @package ParagonIE\Corner\Tests
 */
class FooError extends Error
{
    public function __construct(string $message = "", int $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->helpfulMessage = "This is an example of the Error class";
        $this->supportLink = "https://github.com/paragonie/corner";
    }
}

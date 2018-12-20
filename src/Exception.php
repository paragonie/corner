<?php
declare(strict_types=1);
namespace ParagonIE\Corner;

/**
 * Class Exception
 * @package ParagonIE\Corner
 */
class Exception extends \Exception implements CornerInterface
{
    use CornerTrait;
}

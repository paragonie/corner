<?php
namespace ParagonIE\Corner;

/**
 * Class Exception
 * @package ParagonIE\Corner
 */
class Exception extends \Exception implements CornerInterface
{
    use CornerTrait;
}

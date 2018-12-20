<?php
declare(strict_types=1);
namespace ParagonIE\Corner;

/**
 * Class Error
 * @package ParagonIE\Corner
 */
class Error extends \Error implements CornerInterface
{
    use CornerTrait;
}

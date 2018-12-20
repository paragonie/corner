<?php
namespace ParagonIE\Corner\Tests;

use ParagonIE\Corner\CornerInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class BasicTest
 * @package ParagonIE\Corner\Tests
 */
class BasicTest extends TestCase
{
    public function testException()
    {
        try {
            throw new FooException('test');
        } catch (CornerInterface $ex) {
            $this->assertSame('test', $ex->getMessage());
            $this->assertNotEmpty($ex->getHelpfulMessage());
            $this->assertSame('https://github.com/paragonie/corner', $ex->getSupportLink());
        }
    }

    public function testError()
    {
        try {
            throw new FooError('test');
        } catch (CornerInterface $ex) {
            $this->assertSame('test', $ex->getMessage());
            $this->assertNotEmpty($ex->getHelpfulMessage());
            $this->assertSame('https://github.com/paragonie/corner', $ex->getSupportLink());
        }
    }

    public function testSnippet()
    {
        try {
            /** Canary string: 15f3456a04616adc5b42f3533d41a43aa2bad7eee2e914684ec86c3b84b71c61 */
            throw new FooException('test');
        } catch (CornerInterface $ex) {
            $this->assertFalse(
                strpos($ex->getSnippet(0, 0), '15f3456a04616adc5b42f3533d41a43aa2bad7eee2e914684ec86c3b84b71c61')
            );
            $this->assertFalse(
                strpos($ex->getSnippet(0, 1), '15f3456a04616adc5b42f3533d41a43aa2bad7eee2e914684ec86c3b84b71c61')
            );
            $this->assertNotFalse(
                strpos($ex->getSnippet(1, 0), '15f3456a04616adc5b42f3533d41a43aa2bad7eee2e914684ec86c3b84b71c61')
            );
            $this->assertFalse(
                strpos($ex->getSnippet(1, 0, 1), '15f3456a04616adc5b42f3533d41a43aa2bad7eee2e914684ec86c3b84b71c61')
            );
            $this->assertFalse(
                strpos($ex->getSnippet(5, 5, 1), '15f3456a04616adc5b42f3533d41a43aa2bad7eee2e914684ec86c3b84b71c61')
            );
            $this->assertFalse(
                strpos($ex->getSnippet(5, 5, 2), '15f3456a04616adc5b42f3533d41a43aa2bad7eee2e914684ec86c3b84b71c61')
            );
            $this->assertFalse(
                strpos($ex->getSnippet(5, 5, 3), '15f3456a04616adc5b42f3533d41a43aa2bad7eee2e914684ec86c3b84b71c61')
            );
        }

        try {
            /* We're adding some padding here. */

            $this->subcall();

            /* We're adding some padding here. */
        } catch (CornerInterface $ex) {
            $this->assertFalse(
                strpos($ex->getSnippet(1, 1, 1), '15f3456a04616adc5b42f3533d41a43aa2bad7eee2e914684ec86c3b84b71c61')
            );
            $this->assertNotFalse(
                strpos($ex->getSnippet(1, 1, 1), 'subcall()')
            );
        }
    }

    private function subcall()
    {
        /** Canary string: 6115f3456a04616adc5b42f3533d41a43aa2bad7eee2e914684ec86c3b84b71c */
        throw new FooException('test');
    }
}

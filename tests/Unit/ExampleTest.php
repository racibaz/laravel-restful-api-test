<?php

namespace Tests\Unit;

use Exception;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    /**
     * @dataProvider textProvider
     * */
    public function testIsTextSame($text)
    {

        $this->assertSame('test', $text);
    }

    public function textProvider()
    {
        return [
            ['test'],
            ['test'],
        ];
    }
}

<?php

namespace Ht7\Base\Tests;

use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;
use \Ht7\Base\Exceptions\UndefinedConstantException;
use \Ht7\Base\Tests\Implementations\Unit\EnumImplementation;

class EnumTest extends TestCase
{
    private $object;

    protected function setUp(): void
    {
        $this->object = new EnumImplementation();
    }
    /**
     * Test to get a defined constant by comparing the expected value. An undefined
     * constant will throw an exception. This case is tested by this method too.
     */
    public function testGetConstant()
    {
        $this->assertEquals('test 1', EnumImplementation::getConstant('TEST_1'));

        $this->expectException(UndefinedConstantException::class);

        EnumImplementation::getConstant('test_11111');
    }
    /**
     * Test setting an undefined property on the enum, which should throw an
     * exception.
     * This functionallity is implemented by a trait.
     */
    public function testSet()
    {
        $this->expectException(InvalidArgumentException::class);

        $this->object->test = 'Should throw an exception.';
    }
}

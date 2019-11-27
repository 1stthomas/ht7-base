<?php

namespace Ht7\Base\Tests;

use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;
use \Ht7\Base\Exceptions\UndefinedConstantException;
use \Ht7\Base\Tests\Implementations\Unit\EnumImplementation;

/**
 * Test class for the Enum Base class.
 *
 * @author      Thomas Pluess
 * @since       0.0.1
 * @version     0.0.1
 * @copyright (c) 2019, Thomas Pluess
 */
class EnumTest extends TestCase
{

    private $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new EnumImplementation();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {

    }

    /**
     * Test to get a defined constant by comparing the expected value. An undefined
     * constant will throw an exception. This case is tested by this method too.
     */
    public function testGetConstant()
    {
        $this->assertEquals('test 1', EnumImplementation::getConstant('test_1'));

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

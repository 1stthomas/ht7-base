<?php

namespace Ht7\Tests\Base;

use \BadMethodCallException;
use \PHPUnit\Framework\TestCase;
use \Ht7\Tests\Base\Implementations\Ht7ObjectImplementation;

class Ht7ObjectImplementationTest extends TestCase
{

    /**
     * @var Ht7\Tests\Base\Ht7ObjectImplementation
     */
    protected $object;
    
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new Ht7ObjectImplementation('Testname');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * The Ht7ObjectImplementation does only implement the $name property.
     * Therfor only <code>getName()</code> and <code>setName()</code> should be
     * accessable. All other method calls should throw a BadMeThodCallException.
     * 
     * @covers Ht7\Tests\Base\Ht7ObjectImplementation::__call
     * @dataProvider callProvider
     */
    public function test__call($name, $args)
    {
        if (strpos($name, 'get') === 0) {
            if (strpos($name, 'Name') !== false) {
                $this->assertEquals(
                    $args,
                    $this->object->$name()
                );
            } else {
                $this->expectException(BadMethodCallException::class);
                $this->object->$name();
            }
            
        } elseif (strpos($name, 'set') === 0) {
            if (strpos($name, 'Name') !== false) {
                // the setXXX() does not return any value, therefor we test
                // the return value of the corresponding getXXX()
                $this->object->$name($args);

                $this->assertEquals(
                    $args,
                    $this->object->getName()
                );
            } else {
                $this->expectException(BadMethodCallException::class);
                $this->object->$name($args);
            }
            
        } else {
            $this->expectException(BadMethodCallException::class);
            $this->object->$name($args);
        }
    }

    public function callProvider()
    {
        return [
            ['getName', 'Testname'],
            ['setName', 'test01'],
            ['getTest', 'Testname'],
            ['setTest', 'test01'],
            ['doNothing', '']
        ];
    }
}

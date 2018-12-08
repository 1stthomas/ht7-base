<?php

namespace Ht7\Base\Tests;

use \BadMethodCallException;
use \PHPUnit\Framework\TestCase;
use \Ht7\Base\Tests\Implementations\ObjectRestrictedImplementation;

class ObjectRestrictedImplementationTest extends TestCase
{

    /**
     * @var Ht7\Base\Tests\ObjectRestrictedImplementation
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $data = [
            'firstName' => 'John',
            'name' => 'Smith'
        ];

        $this->object = new ObjectRestrictedImplementation($data);
//        print_r($this->object);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {

    }

    /**
     * The ObjectRestrictedImplementation does only implement the $name property.
     * Therfor only <code>getName()</code> and <code>setName()</code> should be
     * accessable. All other method calls should throw a BadMeThodCallException.
     *
     * @covers Ht7\Base\Tests\ObjectRestrictedImplementation::__call
     * @dataProvider callProvider
     */
    public function test__call($name, $args)
    {
        if (!empty($args['assert'])) {
            $assert = $args['assert'];

            if ($assert === 'eq' || $assert === 'neq') {
                if (strlen($name) > 3 && strpos($name, 'get') === 0) {
                    $this->assertEquals(
                            $args[$assert], $this->object->$name()
                    );
                } elseif (strlen($name) > 3 && strpos($name, 'set') === 0) {
                    // Use setPropertyName() to set the new value.
                    $this->object->$name($args['param']);
                    // Determine the method name to make the desired assertion.
                    $methodName = $assert === 'eq' ? 'assertEquals' : 'assertNotEquals';
                    // Now we need to check, if the new value was really set.
                    // Therefor the start of the method name must change from
                    // "set" to "get".
                    $nameNew = substr_replace($name, 'g', 0, 1);
                    // make the assertion
                    $this->$methodName(
                            $args[$assert], $this->object->$nameNew()
                    );
                }
            } elseif ($assert === 'exception') {
                $this->expectException(BadMethodCallException::class);

                if (isset($args['param'])) {
                    $this->object->$name($args['param']);
                } else {
                    $this->object->$name();
                }
            } elseif ($assert === 'instanceof') {
                $return = $this->object->$name();

                $err = sprintf("Calling %s() returns wrong type.\n", $name);

                $this->assertInstanceOf($args['return'], $return, $err);
            }
        }
    }

    public function callProvider()
    {
        return [
            ['getOrOptions', [
                    'assert' => 'instanceof',
                    'return' => 'Ht7\Base\OrOptionsAbstract'
                ]
            ],
            ['getName', [
                    'assert' => 'eq',
                    'eq' => 'Smith'
                ]
            ],
            ['getFirstName', [
                    'assert' => 'eq',
                    'eq' => 'John'
                ]
            ],
            ['getNameNo', [
                    'assert' => 'exception'
                ]
            ],
            ['setName', [
                    'assert' => 'eq',
                    'eq' => 'test01',
                    'param' => 'test01'
                ]
            ],
            ['setFirstName', [
                    'assert' => 'eq',
                    'eq' => 'test02',
                    'param' => 'test02'
                ]
            ],
            ['setName', [
                    'assert' => 'neq',
                    'neq' => 'test02',
                    'param' => 'test01'
                ]
            ],
            ['setNameNo', [
                    'assert' => 'exception',
                    'param' => 'test01'
                ]
            ],
            ['doNothing', [
                    'assert' => 'exception'
                ]
            ],
        ];
    }

}

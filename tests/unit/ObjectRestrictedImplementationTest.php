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

    /**
     * Test the object restricted options instance.
     *
     * @covers Ht7\Base\Tests\ObjectRestrictedImplementation::getOrOptions
     * @dataProvider optionsProvider
     */
    public function testGetOrOptions($args)
    {
        if ($args['assert'] === 'eq') {
            $opt = $this->object->getOrOptions();

            $expVars = [];
            if (isset($args['param']['exportVars'])) {
                $param = $args['param'];
                $expVars = $param['exportVars'];
                unset($param['exportVars']);
                unset($param['hasExportVars']);
            }

            foreach ($param as $name => $value) {
                $opt->$name = $value;
            }

            $opt->setExportVars($expVars);

            $opt2 = $this->object->getOrOptions();
            $opt2Values = $opt2->jsonSerialize();

            if ($args['eq'] === 'param') {
                $this->assertEquals($args['param'], $opt2Values);
            } else {
                $this->assertEquals($args['eq'], $opt2Values);
            }
        }
    }

    public function optionsProvider()
    {
        return [
            'Check of the options class' => [
                [
                    'assert' => 'eq',
                    'param' => [
                        'exportVars' => [
                            'firstName',
                            'name'
                        ],
                        'hasExportVars' => true,
                        'hasMethodRestriction' => true,
                        'hasVarRestriction' => true,
                        'lockProperties' => false
                    ],
                    'eq' => 'param'
                ]
            ]
        ];
    }

    /**
     * Test the object restricted serialization behavior.
     *
     * @covers Ht7\Base\Tests\ObjectRestrictedImplementation::serialize
     * @dataProvider serializeProvider
     */
    public function testSerialize($assert, $args)
    {
        if ($assert === 'eq') {
            if (isset($args['option'])) {
                $opt = $this->object->getOrOptions();

                if (isset($args['option']['exportVars'])) {
                    $opt->setExportVars($args['option']['exportVars']);
                    unset($args['option']['exportVars']);
                }

                foreach ($args['option'] as $name => $value) {
                    $opt->$name = $value;
                }
            }

            if (isset($args['do'])) {
                if ($args['do'] === 'double') {
                    $str1 = serialize($this->object);
                    $objTmp = unserialize($str1);
                    $str2 = serialize($objTmp);
                }
            } else {
                $str2 = serialize($this->object);
            }

            $this->assertEquals($args['eq'], $str2);
        }
    }

    public function serializeProvider()
    {
        return [
            [
                'eq',
                [
                    'eq' => 'C:61:"Ht7\Base\Tests\Implementations\ObjectRestrictedImplementation":214:{a:3:{s:9:"firstName";s:4:"John";s:4:"name";s:5:"Smith";s:9:"orOptions";a:5:{s:13:"hasExportVars";b:0;s:20:"hasMethodRestriction";b:0;s:17:"hasVarRestriction";b:0;s:14:"lockProperties";b:1;s:10:"exportVars";a:0:{}}}}'
                ]
            ],
            [
                'eq',
                [
                    'eq' => 'C:61:"Ht7\Base\Tests\Implementations\ObjectRestrictedImplementation":269:{a:3:{s:9:"firstName";s:4:"John";s:4:"name";s:5:"Smith";s:9:"orOptions";a:5:{s:13:"hasExportVars";b:1;s:20:"hasMethodRestriction";b:0;s:17:"hasVarRestriction";b:0;s:14:"lockProperties";b:1;s:10:"exportVars";a:3:{i:0;s:9:"firstName";i:1;s:4:"name";i:2;s:9:"orOptions";}}}}',
                    'option' => [
                        'exportVars' => [
                            'firstName',
                            'name',
                            'orOptions'
                        ]
                    ]
                ],
                [
                    'do' => 'double',
                    'eq' => 'C:61:"Ht7\Base\Tests\Implementations\ObjectRestrictedImplementation":269:{a:3:{s:9:"firstName";s:4:"John";s:4:"name";s:5:"Smith";s:9:"orOptions";a:5:{s:13:"hasExportVars";b:1;s:20:"hasMethodRestriction";b:0;s:17:"hasVarRestriction";b:0;s:14:"lockProperties";b:1;s:10:"exportVars";a:3:{i:0;s:9:"firstName";i:1;s:4:"name";i:2;s:9:"orOptions";}}}}',
                    'option' => [
                        'exportVars' => [
                            'firstName',
                            'name',
                            'orOptions'
                        ]
                    ]
                ]
            ]
        ];
    }

}

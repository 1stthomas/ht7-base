<?php

namespace Ht7\Base\Tests;

use \BadMethodCallException;
use OutOfBoundsException;
use PHPUnit\Framework\TestCase;
use Ht7\Base\ObjectRestricted;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2018-12-01 at 20:41:17.
 */
class ObjectRestrictedTest extends TestCase
{

    /**
     * @var Ht7\Base\ObjectRestricted
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new ObjectRestricted;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {

    }

    /**
     * @covers Ht7\Base\ObjectRestricted::__call
     * @dataProvider callProvider
     */
    public function test__call($name, $args)
    {
        if (!empty($args['assert'])) {
            $assert = $args['assert'];

            if ($assert === 'exception') {
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
            ['getName', ['assert' => 'exception']],
            ['setName', [
                    'assert' => 'exception',
                    'param' => 'test01'
                ]
            ],
            ['getTest', ['assert' => 'exception']],
            ['setTest', [
                    'assert' => 'exception',
                    'param' => 'test02'
                ]
            ]
        ];
    }

    /**
     *
     * @param   string  $assert
     * @param   array   $args
     * @covers  Ht7\Base\ObjectRestricted::jsonSerialize
     * @dataProvider jsonSerializeProvider
     */
    public function testJsonSerialize($assert, $args)
    {
        $options = $this->object->getOrOptions();

        if (!empty($args['param'])) {
            $options->lockProperties = false;
            foreach ($args['param'] as $key => $value) {
                $this->object->$key = $value;
            }
            $options->lockProperties = true;
        }

        if ($assert === 'eq') {
            $assertVal = $args['eq'];
            $testVal = json_encode($this->object);

            $this->assertEquals($assertVal, $testVal);
        }
    }

    public function jsonSerializeProvider()
    {
        return [
            [
                'assert' => 'eq',
                [
                    'eq' => '{"orOptions":{"hasExportVars":false,"hasMethodRestriction":false,"hasVarRestriction":false,"lockProperties":true,"exportVars":[]}}'
//                    'eq' => 'C:61:"Ht7\Base\Tests\Implementations\ObjectRestrictedImplementation":214:{a:3:{s:9:"firstName";s:4:"John";s:4:"name";s:5:"Smith";s:9:"orOptions";a:5:{s:13:"hasExportVars";b:0;s:20:"hasMethodRestriction";b:0;s:17:"hasVarRestriction";b:0;s:14:"lockProperties";b:1;s:10:"exportVars";a:0:{}}}}'
                ]
            ],
            [
                'assert' => 'eq',
                [
                    'param' => [
                        'test' => 'test01',
                        'test2' => 'test02'
                    ],
                    'eq' => '{"test":"test01","test2":"test02","orOptions":{"hasExportVars":false,"hasMethodRestriction":false,"hasVarRestriction":false,"lockProperties":true,"exportVars":[]}}'
                ]
            ]
        ];
    }

    /**
     *
     * @param   string  $assert
     * @param   array   $args
     * @covers  Ht7\Base\ObjectRestricted::load
     * @dataProvider loadProvider
     */
    public function testLoad($assert, $args)
    {
        $option = $this->object->getOrOptions();

        if (!empty($args['option'])) {
            if (!empty($args['option']['exportVars'])) {
                $option->setExportVars($args['option']['exportVars']);
            } else {
                foreach ($args['option'] as $key => $opt) {
                    $option->$key = $opt;
                }
            }
        }

        if ($assert === 'eq') {
            $option->lockProperties = false;

            $assertVal = $args[$assert] == 'param' ? $args['param'] : $args[$assert];

            $this->object->load($args['param']);

            $this->assertEquals($assertVal, $this->object->jsonSerialize());
        } elseif ($assert === 'exception') {
            $this->expectException(OutOfBoundsException::class);

            $this->object->load($args['param']);
        }
    }

    public function loadProvider()
    {
        return [
            [
                'assert' => 'eq',
                [
                    'eq' => 'param',
                    'option' => [
                        'exportVars' => [
                            'name',
                            'firstName'
                        ],
                        'lockProperties' => false
                    ],
                    'param' => [
                        'name' => 'John',
                        'firstName' => 'Smith'
                    ]
                ]
            ],
            [
                'assert' => 'eq',
                [
                    'eq' => [
                        'name' => 'John',
                        'firstName' => 'Smith'
                    ],
                    'option' => [
                        'exportVars' => [
                            'name',
                            'firstName'
                        ],
                        'lockProperties' => false
                    ],
                    'param' => [
                        'name' => 'John',
                        'firstName' => 'Smith',
                        'test01' => 'Testtest',
                        'test02' => 'Testtest2'
                    ]
                ]
            ],
            [
                'assert' => 'exception',
                [
                    'param' => [
                        'name' => 'John',
                        'firstName' => 'Smith'
                    ]
                ]
            ]
        ];
    }

}

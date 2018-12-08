<?php

namespace Ht7\Base\Tests;

use \OutOfBoundsException;
use \PHPUnit\Framework\TestCase;
use \Ht7\Base\OrOptionsFactory;

/**
 * Description of OrOptionsFactory
 *
 * @author 1stthomas
 */
class OrOptionsFactoryTest extends TestCase
{

    /**
     * @var Ht7\Base\OrOptionsFactory
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new OrOptionsFactory;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {

    }

    /**
     * @covers Ht7\Base\OrOptionsFactory::load
     * @dataProvider loadProvider
     */
    public function testLoad($assert, $args)
    {
        $type = $args['type'];
        $option = $this->object->$type();

        if ($assert === 'eq' || $assert === 'neq') {
            if (isset($args['param'])) {
                $option->load($args['param']);
            }

            $methodName = $assert === 'eq' ? 'assertEquals' : 'assertNotEquals';

            if ($args[$assert] === 'param') {
                $assertVal = $args['param'];
            } else {
                $assertVal = $args[$assert];
            }

            foreach ($assertVal as $name => $value) {
                if (is_array($value)) {
                    $expV = $option->getExportVars();
                    $this->$methodName($assertVal[$name], $expV);
                } else {
                    $this->$methodName($assertVal[$name], $option->$name);
                }
            }

            $expV = $option->getExportVars();
            $this->assertEquals($assertVal['exportVars'], $expV);
        } elseif ($assert === 'exception') {
            $this->expectException(OutOfBoundsException::class);

            $option->load($args['param']);
        } elseif ($assert === 'instanceof') {
            $type = $args['type'];

            $name = get_class($option);
            $err = sprintf("Calling %s() returns wrong type.\n", $name);

            $this->assertInstanceOf($args['eq'], $option, $err);
        }
    }

    public function loadProvider()
    {
        return [
            [
                'assert' => 'instanceof',
                [
                    'eq' => 'Ht7\Base\OrOptionsAbstract',
                    'type' => 'getOrOptionRestricted'
                ]
            ],
            [
                'assert' => 'instanceof',
                [
                    'eq' => 'Ht7\Base\OrOptionsAbstract',
                    'type' => 'getOrOptionDefault'
                ]
            ],
            [
                'assert' => 'eq',
                [
                    'eq' => [
                        'exportVars' => [],
                        'hasVarRestriction' => false,
                        'hasMethodRestriction' => false,
                        'hasVarRestriction' => false,
                        'lockProperties' => true
                    ],
                    'type' => 'getOrOptionRestricted'
                ]
            ],
            [
                'assert' => 'eq',
                [
                    'eq' => [
                        'exportVars' => [],
                        'hasVarRestriction' => false,
                        'hasMethodRestriction' => false,
                        'hasVarRestriction' => false,
                        'lockProperties' => false
                    ],
                    'type' => 'getOrOptionDefault'
                ]
            ],
            [
                'assert' => 'eq',
                [
                    'param' => [
                        'exportVars' => [
                            'name' => 'TestName',
                            'firstName' => 'TestFristName'
                        ],
                        'hasVarRestriction' => true,
                        'hasMethodRestriction' => true,
                        'hasVarRestriction' => true,
                        'lockProperties' => false
                    ],
                    'eq' => 'param',
                    'type' => 'getOrOptionRestricted'
                ]
            ],
            [
                'assert' => 'exception',
                [
                    'param' => [
                        'exportVars' => [
                            'name' => 'TestName',
                            'firstName' => 'TestFristName'
                        ],
                        'hasVarRestriction' => true,
                        'hasMethodRestriction' => true,
                        'hasVarRestriction' => true,
                        'lockProperties' => false,
                        'inexistent' => false
                    ],
                    'type' => 'getOrOptionRestricted'
                ]
            ],
        ];
    }

}

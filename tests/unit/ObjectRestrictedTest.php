<?php

namespace Ht7\Base\Tests;

use \BadMethodCallException;
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

}

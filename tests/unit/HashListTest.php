<?php

namespace Ht7\Base\Tests;

use \InvalidArgumentException;
use \stdClass;
use \PHPUnit\Framework\TestCase;
use \Ht7\Base\Lists\HashList;
use \Ht7\Base\Tests\Implementations\Unit\HashListItemImplementation;

/**
 * Test class for the Enum Base class.
 *
 * @author      Thomas Pluess
 * @since       0.0.1
 * @version     0.0.1
 * @copyright (c) 2019, Thomas Pluess
 */
class HashListTest extends TestCase
{

    public function testConstructor()
    {
        $data = [
            (new HashListItemImplementation('one', 'v1')),
            (new HashListItemImplementation('two', 'v2'))
        ];

        $hL = new HashList($data);

        $items = $hL->getAll();

        $this->assertCount(2, $items);

        return $hL;
    }

    /**
     * @depends testConstructor
     */
    public function testAdd(HashList $hL)
    {
        $hi1 = new HashListItemImplementation('three', 'v3');
        $hi2 = new HashListItemImplementation('two', 'v2a');
        $hL->add($hi1);
        $hL->add($hi2);

        $items = $hL->getAll();

        $this->assertCount(3, $items);

        $this->assertArrayHasKey('one', $items);
        $this->assertArrayHasKey('two', $items);
        $this->assertArrayHasKey('three', $items);

        $this->assertEquals('v3', $hL->get('three')->getValue());
        $this->assertEquals('v2a', $hL->get('two')->getValue());

        $this->expectException(InvalidArgumentException::class);
        $hL->add('Should fail');

        $this->expectException(InvalidArgumentException::class);
        $test = new stdClass();
        $hL->add($test);
    }

}

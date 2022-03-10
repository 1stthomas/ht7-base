<?php

namespace Ht7\Base\Tests\Integration;

use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;
use \Ht7\Base\Lists\ItemList;

/**
 * Test class for the Enum Base class.
 *
 * @author      Thomas Pluess
 * @since       0.0.1
 * @version     0.0.1
 * @copyright (c) 2019, Thomas Pluess
 */
class ItemListTest extends TestCase
{

    public function testConstructor()
    {
        $data = [
            'one',
            'two'
        ];

        $iL = new ItemList($data);

        $items = $iL->getAll();

        $this->assertCount(2, $items);

        $this->assertEquals('one', $items[0]);
        $this->assertEquals('two', $items[1]);

        return $iL;
    }

    /**
     * @depends testConstructor
     */
    public function testAdd(ItemList $iL)
    {
        $iL->add(null);
        $iL->add('one');
        $iL->add('two')->add('two');

        $items = $iL->getAll();

        $this->assertCount(6, $items);

        $this->assertEquals(null, $items[2]);
        $this->assertEquals('one', $items[3]);
        $this->assertEquals('two', $items[4]);
        $this->assertEquals('two', $items[5]);

        return $iL;
    }

    /**
     * @depends testAdd
     */
    public function testCount(ItemList $iL)
    {
        $this->assertCount(6, $iL);

        return $iL;
    }

    /**
     * @depends testCount
     */
    public function testForEach(ItemList $iL)
    {
        $i = 0;

        foreach ($iL as $item) {
            if ($i === 2) {
                $this->assertNull($item);
            }

            $i++;
        }

        $this->assertEquals(6, $i);

        return $iL;
    }

    /**
     * @depends testForEach
     */
    public function testGet(ItemList $iL)
    {
        $item1 = $iL->get(0);
        $item2 = $iL->get(2);

        $this->assertEquals('one', $item1);
        $this->assertEquals(null, $item2);

        return $iL;
    }

    /**
     * @depends testGet
     */
    public function testHas(ItemList $iL)
    {
        $this->assertTrue($iL->has(5));
        $this->assertFalse($iL->has(6));

        return $iL;
    }

    /**
     * @depends testHas
     */
    public function testHasByValue(ItemList $iL)
    {
        $iL->add('ten');

        $this->assertTrue($iL->hasByValue('ten'));

        return $iL;
    }

    /**
     * @depends testHasByValue
     */
    public function testRestricted(ItemList $iL)
    {
        $this->expectException(InvalidArgumentException::class);

        $iL->test = 'Should fail';
    }

}

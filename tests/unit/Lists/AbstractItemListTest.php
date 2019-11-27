<?php

namespace Ht7\Base\Tests;

use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;
use \Ht7\Base\Tests\Implementations\Unit\ItemImplementation;
use \Ht7\Base\Tests\Implementations\Unit\ItemListImplementation;

/**
 * Test class for the Enum Base class.
 *
 * @author      Thomas Pluess
 * @since       0.0.1
 * @version     0.0.1
 * @copyright (c) 2019, Thomas Pluess
 */
class AbstractItemListTest extends TestCase
{

    private $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new ItemListImplementation();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {

    }

    public function testAddItems()
    {
        $item = new ItemImplementation('test11');
        $this->object->addItem($item);

        $items = $this->object->getItems();

        $this->assertArrayHasKey('test11', $items);
    }

    public function testForEach()
    {
        $i = 1;

        foreach ($this->object as $key => $value) {
            $expectedKey = 'test00' . $i;
            $this->assertEquals($expectedKey, $key);
            $this->assertInstanceOf(ItemImplementation::class, $value);

            $i++;
        }
    }

    public function testGetItem()
    {
        $item = $this->object->getItem('test002');

        $itemExpected = new ItemImplementation('test002');

        $this->assertEquals($itemExpected->getIdentifier(), $item->getIdentifier());
    }

    /**
     */
    public function testGetItems()
    {
        $items = $this->object->getItems();

        $item1 = new ItemImplementation('test001');
        $item2 = new ItemImplementation('test002');

        $this->assertEquals(['test001' => $item1, 'test002' => $item2], $items);
    }

    public function testHasItem()
    {
        $this->assertTrue($this->object->hasItem('test001'));
    }

    public function testRestricted()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->object->test = 'Should fail';
    }

}

<?php

namespace Ht7\Base\Tests\Lists;

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
        // see: http://miljar.github.io/blog/2013/12/20/phpunit-testing-the-constructor/
        $className = ItemList::class;
        $items = [1, 2, 3];

        $mock = $this->getMockBuilder($className)
                ->setMethods(['load'])
                ->disableOriginalConstructor()
                ->getMock();

        $mock->expects($this->once())
                ->method('load')
                ->with($this->equalTo($items));

        $reflectedClass = new \ReflectionClass($className);
        $constructor = $reflectedClass->getConstructor();
        $constructor->invoke($mock, $items);
    }

    public function testAdd()
    {
        // see: https://www.webtipblog.com/unit-testing-private-methods-and-properties-with-phpunit/
        $className = ItemList::class;

        $mock = $this->getMockBuilder($className)
                ->setMethods(['load'])
                ->getMock();

        $reflectedClass = new \ReflectionClass($className);
        $property = $reflectedClass->getProperty('items');
        $property->setAccessible(true);

        $this->assertEquals([], $property->getValue($mock));

        $mock->add('test text');

        $this->assertEquals(['test text'], $property->getValue($mock));

        $mock->add(123);

        $this->assertEquals(['test text', 123], $property->getValue($mock));
    }

    public function testGetAll()
    {
        $className = ItemList::class;

        $mock = $this->getMockBuilder($className)
                ->setMethods(['add'])
                ->disableOriginalConstructor()
                ->getMock();

        $expected = [1, 2, 'test 1', 4, 5];

        $reflectedClass = new \ReflectionClass($className);
        $property = $reflectedClass->getProperty('items');
        $property->setAccessible(true);
        $property->setValue($mock, $expected);

        $this->assertEquals($expected, $property->getValue($mock));
        $this->assertEquals($expected, $mock->getAll());

        return $mock;
    }

    /**
     * @depends testGetAll
     */
    public function testGetByIndex($mock)
    {
        $this->assertEquals('test 1', $mock->get(2));

        return $mock;
    }

    /**
     * @depends testGetByIndex
     */
    public function testCount($mock)
    {
        $this->assertCount(5, $mock);

        return $mock;
    }

    /**
     * @depends testCount
     */
    public function testGetIterator($mock)
    {
        $this->assertInstanceOf(\ArrayIterator::class, $mock->getIterator());
    }

    /**
     * @depends testCount
     */
    public function testHas($mock)
    {
        $this->assertTrue($mock->has(4));
        $this->assertFalse($mock->has(5));

        return $mock;
    }

    /**
     * @depends testCount
     */
    public function testHasByValue($mock)
    {
        $this->assertTrue($mock->hasByValue(4));
        $this->assertTrue($mock->hasByValue('test 1'));
        $this->assertFalse($mock->hasByValue('test'));
        $this->assertFalse($mock->hasByValue('test 2'));
    }

    public function testLoad()
    {
        $className = ItemList::class;

        $mock = $this->getMockBuilder($className)
                ->setMethods(['getIterator'])
                ->getMock();

        $reflectedClass = new \ReflectionClass($className);
        $property = $reflectedClass->getProperty('items');
        $property->setAccessible(true);

        $this->assertEquals([], $property->getValue($mock));

        $expected1 = [1, 2, 3, 'test 1', 5];

        $mock->load($expected1);

        $this->assertEquals($expected1, $property->getValue($mock));

        array_push($expected1, 6, 7);

        $expected2 = [1, 2, 3, 'test 1', 5, 6, 7];
        $mock->load([6, 7]);

        $this->assertEquals($expected2, $property->getValue($mock));
    }

    public function testMerge()
    {
        $className = ItemList::class;
        $items1 = [1, 2, 3];
        $items2 = [1, 2, 4, 3];
        $expected = [1, 2, 3, 1, 2, 4, 3];

        $mock1 = $this->getMockBuilder($className)
                ->setMethods(['getAll'])
                ->disableOriginalConstructor()
                ->getMock();
        $mock1->expects($this->once())
                ->method('getAll')
                ->willReturn($items1);

        $mock2 = $this->getMockBuilder($className)
                ->setMethods(['getAll'])
                ->disableOriginalConstructor()
                ->getMock();
        $mock2->expects($this->once())
                ->method('getAll')
                ->willReturn($items2);

        $mock1->merge($mock2);

        $reflectedClass = new \ReflectionClass($className);
        $property = $reflectedClass->getProperty('items');
        $property->setAccessible(true);
        $actual = $property->getValue($mock1);

        $this->assertSame($expected, $actual);
    }

}

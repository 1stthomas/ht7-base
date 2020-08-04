<?php

namespace Ht7\Base\Tests\Lists;

use \PHPUnit\Framework\TestCase;
use \Ht7\Base\Lists\ItemList;

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

<?php

namespace Ht7\Base\Tests\Lists;

use \PHPUnit\Framework\TestCase;
use \Ht7\Base\Lists\AbstractItemList;

class AbstractItemListTest extends TestCase
{

    public function testConstructor()
    {
        $className = AbstractItemList::class;
        $items = [1, 2, 3, 4, 5];

        $stub = $this->getMockForAbstractClass($className, [], '', true, true, true, ['load']);

        $stub->expects($this->once())
                ->method('load')
                ->with($this->equalTo($items));

        $reflectedClass = new \ReflectionClass($className);
        $constructor = $reflectedClass->getConstructor();
        $constructor->invoke($stub, $items);
    }

    public function testCount()
    {
        $className = AbstractItemList::class;
        $items = [1, 2, 3, 4, 5];

        $stub = $this->getMockForAbstractClass($className, [], '', true, true, true, ['getAll']);

        $stub->expects($this->once())
                ->method('getAll')
                ->willReturn($items);

        $this->assertCount(5, $stub);
    }

    public function testGet()
    {
        $className = AbstractItemList::class;
        $items = [1, 2, 3, 4, 5];

        $stub = $this->getMockForAbstractClass($className);

        $reflectedClass = new \ReflectionClass($className);
        $property = $reflectedClass->getProperty('items');
        $property->setAccessible(true);
        $property->setValue($stub, $items);

        foreach ($items as $key => $value) {
            $this->assertEquals($value, $stub->get($key));
        }
    }

    public function testGetAll()
    {
        $className = AbstractItemList::class;
        $items = [1, 2, 3, 4, 5];

        $stub = $this->getMockForAbstractClass($className);

        $reflectedClass = new \ReflectionClass($className);
        $property = $reflectedClass->getProperty('items');
        $property->setAccessible(true);
        $property->setValue($stub, $items);

        $this->assertEquals($items, $stub->getAll());
    }

    public function testGetIterator()
    {
        $className = AbstractItemList::class;
        $stub = $this->getMockForAbstractClass($className);

        $this->assertInstanceOf(\ArrayIterator::class, $stub->getIterator());
    }

    public function testGetNext()
    {
        $className = AbstractItemList::class;

        $items = [1, 20, 300, 4000, 50000];

        $stub = $this->getMockForAbstractClass($className);

        $reflectedClass = new \ReflectionClass($className);
        $property = $reflectedClass->getProperty('items');
        $property->setAccessible(true);
        $property->setValue($stub, $items);

        $this->assertEquals(50000, $stub->getNext(3));

        $this->assertEquals(null, $stub->getNext(4));
    }

    public function testGetPrevious()
    {
        $className = AbstractItemList::class;

        $items = [1, 20, 300, 4000, 50000];

        $stub = $this->getMockForAbstractClass($className);

        $reflectedClass = new \ReflectionClass($className);
        $property = $reflectedClass->getProperty('items');
        $property->setAccessible(true);
        $property->setValue($stub, $items);

        $this->assertEquals(300, $stub->getPrevious(3));

        $this->assertEquals(null, $stub->getPrevious(0));
    }

    public function testHas()
    {
        $className = AbstractItemList::class;
        $items = [1, 2, 0, 3, 4, 5];

        $stub = $this->getMockForAbstractClass($className);

        $reflectedClass = new \ReflectionClass($className);
        $property = $reflectedClass->getProperty('items');
        $property->setAccessible(true);
        $property->setValue($stub, $items);

        $this->assertTrue($stub->has(0));
        $this->assertTrue($stub->has(2));
        $this->assertTrue($stub->has(5));
        $this->assertFalse($stub->has(6));
        $this->assertFalse($stub->has(10));
    }

    public function testHasByValue()
    {
        $className = AbstractItemList::class;
        $items = [1, 2, 0, 3, 4, 5];

        $stub = $this->getMockForAbstractClass($className);

        $reflectedClass = new \ReflectionClass($className);
        $property = $reflectedClass->getProperty('items');
        $property->setAccessible(true);
        $property->setValue($stub, $items);

        $this->assertTrue($stub->hasByValue(0));
        $this->assertTrue($stub->hasByValue(2));
        $this->assertTrue($stub->hasByValue(5));
        $this->assertFalse($stub->hasByValue(6));
        $this->assertFalse($stub->hasByValue(10));
    }

    public function testLoad()
    {
        $className = AbstractItemList::class;
        $items = [1, 2, 0, 3, 4, 5];

        $stub = $this->getMockForAbstractClass($className);

        $stub->expects($this->exactly(6))
                ->method('add')
                ->withConsecutive(
                        [$this->equalTo(1)],
                        [$this->equalTo(2)],
                        [$this->equalTo(0)],
                        [$this->equalTo(3)],
                        [$this->equalTo(4)],
                        [$this->equalTo(5)]
        );

        $stub->load($items);
    }

}

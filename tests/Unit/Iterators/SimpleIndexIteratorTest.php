<?php

namespace Ht7\Base\Tests\Unit\Iterators;

use \Iterator;
use \Ht7\Base\Iterators\SimpleIndexIterator;
use \PHPUnit\Framework\TestCase;

class SimpleIndexIteratorTest extends TestCase
{

    public function testConstruct()
    {
        $className = SimpleIndexIterator::class;

        $data = [
            'test_1',
            'test2'
        ];

        $mock = $this->getMockBuilder($className)
                ->setMethods(['rewind'])
                ->disableOriginalConstructor()
                ->getMock();
        $mock->expects($this->once())
                ->method('rewind');

        $this->assertInstanceOf(Iterator::class, $mock);

        $reflectedClass = new \ReflectionClass($className);
        $constructor = $reflectedClass->getConstructor();
        $constructor->invoke($mock, $data);
        $property = $reflectedClass->getProperty('array');
        $property->setAccessible(true);

        $this->assertEquals($data, $property->getValue($mock));
    }

    public function testCurrent()
    {
        $className = SimpleIndexIterator::class;

        $data = [
            'test_1',
            'test2'
        ];

        $mock = $this->getMockBuilder($className)
                ->setMethods(['key'])
                ->disableOriginalConstructor()
                ->getMock();
        $mock->expects($this->once())
                ->method('key')
                ->willReturn(1);

        $reflectedClass = new \ReflectionClass($className);
        $property = $reflectedClass->getProperty('array');
        $property->setAccessible(true);

        $property->setValue($mock, $data);

        $this->assertEquals($data[1], $mock->current());
    }

    public function testKey()
    {
        $className = SimpleIndexIterator::class;

        $mock = $this->getMockBuilder($className)
                ->setMethods(['current'])
                ->disableOriginalConstructor()
                ->getMock();

        $reflectedClass = new \ReflectionClass($className);
        $property = $reflectedClass->getProperty('position');
        $property->setAccessible(true);

        $property->setValue($mock, 5);

        $this->assertEquals(5, $mock->key());
    }

    public function testRewind()
    {
        $className = SimpleIndexIterator::class;

        $mock = $this->getMockBuilder($className)
                ->setMethods(['current'])
                ->disableOriginalConstructor()
                ->getMock();

        $reflectedClass = new \ReflectionClass($className);
        $property = $reflectedClass->getProperty('position');
        $property->setAccessible(true);

        $property->setValue($mock, 5);

        $this->assertEquals(5, $property->getValue($mock));

        $mock->rewind();

        $this->assertEquals(0, $property->getValue($mock));
    }

    public function testNext()
    {
        $className = SimpleIndexIterator::class;

        $mock = $this->getMockBuilder($className)
                ->setMethods(['current'])
                ->disableOriginalConstructor()
                ->getMock();

        $reflectedClass = new \ReflectionClass($className);
        $property = $reflectedClass->getProperty('position');
        $property->setAccessible(true);

        $property->setValue($mock, 1);

        $this->assertEquals(1, $property->getValue($mock));

        $mock->next();

        $this->assertEquals(2, $property->getValue($mock));
    }

    public function testValid()
    {
        $className = SimpleIndexIterator::class;

        $data = [
            'test_1',
            'test2'
        ];

        $mock = $this->getMockBuilder($className)
                ->setMethods(['key'])
                ->disableOriginalConstructor()
                ->getMock();
        $mock->expects($this->exactly(2))
                ->method('key')
                ->willReturnOnConsecutiveCalls(1, 2);

        $reflectedClass = new \ReflectionClass($className);
        $propertyArray = $reflectedClass->getProperty('array');
        $propertyArray->setAccessible(true);
        $propertyArray->setValue($mock, $data);

        $this->assertTrue($mock->valid());

        $this->assertFalse($mock->valid());
    }

}

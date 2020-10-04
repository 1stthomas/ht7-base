<?php

namespace Ht7\Base\Tests\Unit\Iterators;

use \Iterator;
use \Ht7\Base\Iterators\SimpleAssocIterator;
use \PHPUnit\Framework\TestCase;

class SimpleAssocIteratorTest extends TestCase
{

    public function testConstruct()
    {
        $className = SimpleAssocIterator::class;

        $data = [
            'key1' => 'test_1',
            'key2' => 'test2'
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
        $propertyArray = $reflectedClass->getProperty('array');
        $propertyArray->setAccessible(true);

        $this->assertEquals($data, $propertyArray->getValue($mock));

        $propertyArrayKeys = $reflectedClass->getProperty('keys');
        $propertyArrayKeys->setAccessible(true);

        $this->assertEquals(['key1', 'key2'], $propertyArrayKeys->getValue($mock));
    }

    public function testKey()
    {
        $className = SimpleAssocIterator::class;

        $keys = [
            'key1',
            'key2',
            'key3',
            'key4',
            'key5'
        ];

        $mock = $this->getMockBuilder($className)
                ->setMethods(['current'])
                ->disableOriginalConstructor()
                ->getMock();

        $reflectedClass = new \ReflectionClass($className);

        $propertyKeys = $reflectedClass->getProperty('keys');
        $propertyKeys->setAccessible(true);
        $propertyKeys->setValue($mock, $keys);

        $propertyPosition = $reflectedClass->getProperty('position');
        $propertyPosition->setAccessible(true);
        $propertyPosition->setValue($mock, 4);

        $this->assertEquals('key5', $mock->key());
    }

    public function testValid()
    {
        $className = SimpleAssocIterator::class;

        $keys = [
            'key1',
            'key2',
            'key3',
            'key4',
            'key5'
        ];

        $mock = $this->getMockBuilder($className)
                ->setMethods(['key'])
                ->disableOriginalConstructor()
                ->getMock();

        $reflectedClass = new \ReflectionClass($className);
        $propertyKeys = $reflectedClass->getProperty('keys');
        $propertyKeys->setAccessible(true);
        $propertyKeys->setValue($mock, $keys);
        $propertyPosition = $reflectedClass->getProperty('position');
        $propertyPosition->setAccessible(true);
        $propertyPosition->setValue($mock, 4);

        $this->assertTrue($mock->valid());

        $propertyPosition->setValue($mock, 5);

        $this->assertFalse($mock->valid());
    }

}

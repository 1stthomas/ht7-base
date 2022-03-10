<?php

namespace Ht7\Base\Tests\Unit\Validation\Lists;

use \Ht7\Base\Validation\Lists\TypeList;
use \Ht7\Base\Validation\Options\TypeListOptions;
use \PHPUnit\Framework\TestCase;

class TypeListTest extends TestCase
{

    public function testConstruct()
    {
        $className = TypeList::class;
        $className2 = TypeListOptions::class;

        $expected = [
            'test1' => 'test_01',
            'test2' => 'test_02',
        ];
        $options = [
            'test1',
            'isCached' => true
        ];

        $stubOptions = $this->createMock($className2);
        $mock = $this->getMockBuilder($className)
                ->setMethods(['createOptionsFromArray', 'setOptions', 'load'])
                ->disableOriginalConstructor()
                ->getMock();

        $mock->expects($this->once())
                ->method('createOptionsFromArray')
                ->with($this->equalTo($options))
                ->willReturn($stubOptions);
        $mock->expects($this->once())
                ->method('setOptions')
                ->with($this->equalTo($stubOptions));
        $mock->expects($this->once())
                ->method('load')
                ->with($this->equalTo($expected));

        $reflectedClass = new \ReflectionClass($className);
        $constructor = $reflectedClass->getConstructor();
        $constructor->invoke($mock, $expected, $options);
    }

    public function testCreateOptionsFromArray()
    {
        $className = TypeList::class;
        $className2 = TypeListOptions::class;

        $mock = $this->getMockBuilder($className)
                // Without this definition the test would fail due tue null
                // return value of the method createOptionsFromArray.
                ->setMethods(['load'])
                ->disableOriginalConstructor()
                ->getMock();

        $this->assertInstanceOf($className2, $mock->createOptionsFromArray([]));
    }

    public function testGetReturnCachedObject()
    {
        $className = TypeList::class;

        $items = [
            'test1' => \InvalidArgumentException::class,
            'test2' => (new \stdClass())
        ];

        $mock = $this->getMockBuilder($className)
                ->setMethods(['load'])
                ->disableOriginalConstructor()
                ->getMock();

        $reflectedClass = new \ReflectionClass($className);
        $property = $reflectedClass->getProperty('items');
        $property->setAccessible(true);
        $property->setValue($mock, $items);

        $this->assertInstanceOf(\stdClass::class, $mock->get('test2'));
    }

    public function testGetReturnNewObject()
    {
        $className = TypeList::class;
        $className2 = TypeListOptions::class;

        $items = [
            'test1' => \InvalidArgumentException::class,
            'test2' => (new \stdClass())
        ];

        $mockOptions = $this->getMockBuilder($className2)
                ->setMethods(['getIsCached'])
                ->disableOriginalConstructor()
                ->getMock();
        $mockOptions->expects($this->once())
                ->method('getIsCached')
                ->willReturn(false);

        $mock = $this->getMockBuilder($className)
                ->setMethods(['getOptions'])
                ->disableOriginalConstructor()
                ->getMock();
        $mock->expects($this->once())
                ->method('getOptions')
                ->willReturn($mockOptions);

        $reflectedClass = new \ReflectionClass($className);
        $property = $reflectedClass->getProperty('items');
        $property->setAccessible(true);
        $property->setValue($mock, $items);

        $this->assertInstanceOf(\InvalidArgumentException::class, $mock->get('test1'));

        $this->assertIsString($property->getValue($mock)['test1']);
    }

    public function testGetReturnNewObjectCacheNewObject()
    {
        $className = TypeList::class;
        $className2 = TypeListOptions::class;

        $items = [
            'test1' => \InvalidArgumentException::class,
            'test2' => (new \stdClass())
        ];

        $mockOptions = $this->getMockBuilder($className2)
                ->setMethods(['getIsCached'])
                ->disableOriginalConstructor()
                ->getMock();
        $mockOptions->expects($this->once())
                ->method('getIsCached')
                ->willReturn(true);

        $mock = $this->getMockBuilder($className)
                ->setMethods(['getOptions'])
                ->disableOriginalConstructor()
                ->getMock();
        $mock->expects($this->once())
                ->method('getOptions')
                ->willReturn($mockOptions);

        $reflectedClass = new \ReflectionClass($className);
        $property = $reflectedClass->getProperty('items');
        $property->setAccessible(true);
        $property->setValue($mock, $items);

        $this->assertInstanceOf(\InvalidArgumentException::class, $mock->get('test1'));

        $this->assertIsObject($property->getValue($mock)['test1']);

        $this->assertInstanceOf(\InvalidArgumentException::class, $mock->get('test1'));
    }

    public function testGetOptions()
    {
        $className = TypeList::class;

        $expected = [
            'test' => 'test val'
        ];

        $mock = $this->getMockBuilder($className)
                ->setMethods(['load'])
                ->disableOriginalConstructor()
                ->getMock();

        $reflectedClass = new \ReflectionClass($className);
        $property = $reflectedClass->getProperty('options');
        $property->setAccessible(true);
        $property->setValue($mock, $expected);

        $this->assertEquals($expected, $mock->getOptions());
    }

    public function testSetOptions()
    {
        $className = TypeList::class;
        $className2 = TypeListOptions::class;

        $mockOptions = $this->getMockBuilder($className2)
                ->setMethods(['getIsCached'])
                ->disableOriginalConstructor()
                ->getMock();

        $mock = $this->getMockBuilder($className)
                ->setMethods(['load'])
                ->disableOriginalConstructor()
                ->getMock();

        $mock->setOptions($mockOptions);

        $reflectedClass = new \ReflectionClass($className);
        $property = $reflectedClass->getProperty('options');
        $property->setAccessible(true);

        $this->assertEquals($mockOptions, $property->getValue($mock));
    }

}

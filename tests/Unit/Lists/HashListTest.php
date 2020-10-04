<?php

namespace Ht7\Base\Tests\Lists;

use \PHPUnit\Framework\TestCase;
use \Ht7\Base\Iterators\SimpleAssocIterator;
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
        // see: http://miljar.github.io/blog/2013/12/20/phpunit-testing-the-constructor/
        $className = HashList::class;
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
        $mock = $this->createMock(HashListItemImplementation::class);

        $mock->expects($this->once())
                ->method('getHash')
                ->willReturn('key1');

        $stub = $this->getMockBuilder(HashList::class)
                ->setMethods(['load'])
                ->disableOriginalConstructor()
                ->getMock();

        $stub->add($mock);

        $reflectedClass = new \ReflectionClass(HashList::class);
        $property = $reflectedClass->getProperty('items');
        $property->setAccessible(true);

        $this->assertArrayHasKey('key1', $property->getValue($stub));

        $mock2 = $this->createMock(HashListItemImplementation::class);

        $mock2->expects($this->once())
                ->method('getHash')
                ->willReturn('key2');

        $stub->add($mock2);

        $this->assertArrayHasKey('key2', $property->getValue($stub));
    }

    public function testaddWithExpection()
    {
        $mock = $this->getMockBuilder(HashList::class)
                ->setMethods(['load'])
                ->disableOriginalConstructor()
                ->getMock();

        $this->expectException(\InvalidArgumentException::class);

        $mock->add('123 yeah!');
    }

    public function testGetIterator()
    {
        $className = HashList::class;

        $items = [
            'test_1' => 'test 1',
            'test_2' => 'test 2',
            'test_3' => 'test 3',
        ];

        $stub = $this->getMockBuilder($className)
                ->setMethods(['getAll'])
                ->disableOriginalConstructor()
                ->getMock();
        $stub->expects($this->once())
                ->method('getAll')
                ->willReturn($items);

        $it = $stub->getIterator();

        $this->assertInstanceOf(SimpleAssocIterator::class, $it);

        $reflectedClass = new \ReflectionClass(SimpleAssocIterator::class);
        $property = $reflectedClass->getProperty('array');
        $property->setAccessible(true);

        $this->assertEquals($items, $property->getValue($it));
    }

    public function testGetNext()
    {
        $className = HashList::class;

        $items = [
            'test_1' => 'test 1',
            'test_2' => 'test 2',
            'test_3' => 'test 3',
        ];
        $indexInvalid = 'test_4';

        $stub = $this->getMockBuilder($className)
                ->setMethods(['handleInvalidIndex'])
                ->disableOriginalConstructor()
                ->getMock();

        $reflectedClass = new \ReflectionClass($className);
        $property = $reflectedClass->getProperty('items');
        $property->setAccessible(true);
        $property->setValue($stub, $items);

        $this->assertEquals('test 3', $stub->getNext('test_2'));

        $this->assertEquals(null, $stub->getNext('test_3'));

        $stub->expects($this->once())
                ->method('handleInvalidIndex')
                ->with($indexInvalid);

        $stub->getNext('test_4');
    }

    public function testGetPrevious()
    {
        $className = HashList::class;

        $items = [
            'test_1' => 'test 1',
            'test_2' => 'test 2',
            'test_3' => 'test 3',
        ];
        $indexInvalid = 'test_4';

        $stub = $this->getMockBuilder($className)
                ->setMethods(['handleInvalidIndex'])
                ->disableOriginalConstructor()
                ->getMock();

        $reflectedClass = new \ReflectionClass($className);
        $property = $reflectedClass->getProperty('items');
        $property->setAccessible(true);
        $property->setValue($stub, $items);

        $this->assertEquals('test 1', $stub->getPrevious('test_2'));

        $this->assertEquals(null, $stub->getPrevious('test_1'));

        $stub->expects($this->once())
                ->method('handleInvalidIndex')
                ->with($indexInvalid);

        $stub->getPrevious($indexInvalid);
    }

    public function testMerge()
    {
        $className = HashList::class;
        $items1 = [
            'item1' => 'val11',
            'item2' => 'val12',
            'item3' => 'val13',
            'item4' => 'val14',
            'item5' => 'val15',
            'item6' => 'val16',
            'item7' => 'val17',
        ];
        $items2 = [
            'item1' => 'val21',
            'item12' => 'val22',
            'item3' => 'val23',
            'item4' => 'val24',
            'item5' => 'val25',
            'item16' => 'val26',
            'item7' => 'val27',
        ];
        $expected = [
            'item1' => 'val11',
            'item12' => 'val22',
            'item3' => 'val13',
            'item4' => 'val14',
            'item5' => 'val15',
            'item16' => 'val26',
            'item7' => 'val17',
            'item2' => 'val12',
            'item6' => 'val16'
        ];

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

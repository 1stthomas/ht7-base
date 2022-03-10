<?php

namespace Ht7\Base\Tests\Models;

use \Ht7\Base\Models\AbstractTransLoadableModel;
use \PHPUnit\Framework\TestCase;

class AbstractTransLoadableModelTest extends TestCase
{

    public function testConstruct()
    {
        $className = AbstractTransLoadableModel::class;

        $items = [1, 2, 5];
        $transformations = [
            'test1' => 'testProperty1',
            'test2' => 'testProperty2',
        ];

        $mock = $this->getMockBuilder($className)
                ->setMethods(['getTransformations', 'setTransformations', 'load'])
                ->getMockForAbstractClass();

        $mock->expects($this->once())
                ->method('setTransformations')
                ->with($this->equalTo($transformations));
        $mock->expects($this->once())
                ->method('load')
                ->with($this->equalTo($items));

        $reflectedClass = new \ReflectionClass($className);
        $constructor = $reflectedClass->getConstructor();
        $constructor->invoke($mock, $items, $transformations);
    }

    public function testLoad()
    {
        $className = AbstractTransLoadableModel::class;

        $items = [1, 2, 5];

        /* @var $mock AbstractTransLoadableModel */
        $mock = $this->getMockBuilder($className)
                ->setMethods(['getTransformations', 'addByPropertyName'])
                ->getMockForAbstractClass();

        $mock->expects($this->once())
                ->method('getTransformations')
                ->willReturn([0 => 10, 1 => 100, 2 => 1000]);
        $mock->expects($this->exactly(3))
                ->method('addByPropertyName')
                ->withConsecutive(
                        [$this->equalTo(10), $this->equalTo(1)],
                        [$this->equalTo(100), $this->equalTo(2)],
                        [$this->equalTo(1000), $this->equalTo(5)]
        );

        $mock->load($items);
    }

    public function testGetTranformations()
    {
        $className = AbstractTransLoadableModel::class;

        $expected = [0 => 10, 5 => 20];

        $mock = $this->getMockForAbstractClass($className);

        $reflectedClass = new \ReflectionClass($className);
        $property = $reflectedClass->getProperty('transformations');
        $property->setAccessible(true);
        $property->setValue($mock, $expected);

        $this->assertEquals($expected, $mock->getTransformations());
    }

    public function testSetTranformations()
    {
        $className = AbstractTransLoadableModel::class;

        $expected = [0 => 10, 5 => 20];

        $mock = $this->getMockForAbstractClass($className);

        $mock->setTransformations($expected);

        $reflectedClass = new \ReflectionClass($className);
        $property = $reflectedClass->getProperty('transformations');
        $property->setAccessible(true);
        $property->setValue($mock, $expected);

        $this->assertEquals($expected, $property->getValue($mock));
    }

}

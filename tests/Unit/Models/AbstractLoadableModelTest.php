<?php

namespace Ht7\Base\Tests\Models;

use \Ht7\Base\Models\AbstractLoadableModel;
use \PHPUnit\Framework\TestCase;

class AbstractLoadableModelTest extends TestCase
{

    public function testConstruct()
    {
        $className = AbstractLoadableModel::class;

        $items = [1, 2, 5];

        $mock = $this->getMockBuilder($className)
                ->setMethods(['load'])
                ->getMockForAbstractClass();

        $mock->expects($this->once())
                ->method('load')
                ->with($this->equalTo($items));

        $reflectedClass = new \ReflectionClass($className);
        $constructor = $reflectedClass->getConstructor();
        $constructor->invoke($mock, $items);
    }

    public function testLoad()
    {
        $className = AbstractLoadableModel::class;

        $items = [1, 2, 5];

        $mock = $this->getMockBuilder($className)
                ->setMethods(['addByPropertyName'])
                ->getMockForAbstractClass();
        $mock->expects($this->exactly(3))
                ->method('addByPropertyName')
                ->withConsecutive([0, 1], [1, 2], [2, 5]);

        $mock->load($items);
    }

}

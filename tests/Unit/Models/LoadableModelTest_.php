<?php

namespace Ht7\Base\Tests\Messages\Options;

use \Ht7\Base\Models\LoadableModel;
use \PHPUnit\Framework\TestCase;

class LoadableModelTest extends TestCase
{

    public function testConstruct()
    {
        $className = LoadableModel::class;

        $items = [1, 2, 5];

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

}

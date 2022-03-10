<?php

namespace Ht7\Base\Tests\Unit\Validation\Options;

use \Ht7\Base\Models\Loadable;
use \Ht7\Base\Validation\Options\TypeListOptions;
use \PHPUnit\Framework\TestCase;

class TypeListOptionsTest extends TestCase
{

    public function testConstruct()
    {
        $className = TypeListOptions::class;

        $mock = $this->getMockBuilder($className)
                ->setMethods(['setIsCached'])
                ->disableOriginalConstructor()
                ->getMock();

        $this->assertInstanceOf(Loadable::class, $mock);
    }

    public function testGetIsCached()
    {
        $className = TypeListOptions::class;

        $mock = $this->getMockBuilder($className)
                ->setMethods(['setIsCached'])
                ->disableOriginalConstructor()
                ->getMock();

        $reflectedClass = new \ReflectionClass($className);
        $property = $reflectedClass->getProperty('isCached');
        $property->setAccessible(true);
        $property->setValue($mock, true);

        $this->assertTrue($mock->getIsCached());

        $property->setValue($mock, false);

        $this->assertFalse($mock->getIsCached());
    }

    public function testSetIsCached()
    {
        $className = TypeListOptions::class;

        $mock = $this->getMockBuilder($className)
                ->setMethods(['getIsCached'])
                ->disableOriginalConstructor()
                ->getMock();

        $reflectedClass = new \ReflectionClass($className);
        $property = $reflectedClass->getProperty('isCached');
        $property->setAccessible(true);

        $this->assertNull($property->getValue($mock));

        $mock->setIsCached(true);

        $this->assertTrue($property->getValue($mock));
    }

}

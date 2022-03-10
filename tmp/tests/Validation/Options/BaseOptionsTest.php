<?php

namespace Ht7\Base\Tests\Unit\Validation\Options;

use \Ht7\Base\Models\Loadable;
use \Ht7\Base\Validation\Options\BaseOptionable;
use \Ht7\Base\Validation\Options\BaseOptions;
use \PHPUnit\Framework\TestCase;

class BaseOptionsTest extends TestCase
{

    public function testConstruct()
    {
        $className = BaseOptions::class;

        $mock = $this->getMockBuilder($className)
                ->setMethods(['getStopOnFail'])
                ->disableOriginalConstructor()
                ->getMock();

        $this->assertInstanceOf(BaseOptionable::class, $mock);
        $this->assertInstanceOf(Loadable::class, $mock);
    }

    public function testGetStopOnFail()
    {
        $className = BaseOptions::class;

        $mock = $this->getMockBuilder($className)
                ->setMethods(['setStopOnFail'])
                ->disableOriginalConstructor()
                ->getMock();

        $reflectedClass = new \ReflectionClass($className);
        $property = $reflectedClass->getProperty('stopOnFail');
        $property->setAccessible(true);
        $property->setValue($mock, true);

        $this->assertTrue($mock->getStopOnFail());

        $property->setValue($mock, false);

        $this->assertFalse($mock->getStopOnFail());
    }

    public function testSetStopOnFail()
    {
        $className = BaseOptions::class;

        $mock = $this->getMockBuilder($className)
                ->setMethods(['getStopOnFail'])
                ->disableOriginalConstructor()
                ->getMock();

        $reflectedClass = new \ReflectionClass($className);
        $property = $reflectedClass->getProperty('stopOnFail');
        $property->setAccessible(true);

        $mock->setStopOnFail(true);
        $this->assertTrue($property->getValue($mock));

        $mock->setStopOnFail(false);
        $this->assertFalse($property->getValue($mock));

        $mock->setStopOnFail(1);
        $this->assertTrue($property->getValue($mock));

        $mock->setStopOnFail(null);
        $this->assertFalse($property->getValue($mock));

        $mock->setStopOnFail((new \stdClass()));
        $this->assertTrue($property->getValue($mock));

        $mock->setStopOnFail(0);
        $this->assertFalse($property->getValue($mock));

        $mock->setStopOnFail(-1);
        $this->assertTrue($property->getValue($mock));

        $mock->setStopOnFail('');
        $this->assertFalse($property->getValue($mock));
    }

}

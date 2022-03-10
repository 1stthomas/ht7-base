<?php

namespace Ht7\Base\Tests\Messages\Options;

use \ReflectionClass;
use \Ht7\Base\Messages\Options\BaseOptions;
use \PHPUnit\Framework\TestCase;

class BaseOptionsTest extends TestCase
{

    public function testLoad()
    {
        $className = BaseOptions::class;

        $data = [
            'stringsClass' => \InvalidArgumentException::class,
        ];

        $mock = $this->getMockBuilder($className)
                ->setMethods(['setStringsClass'])
                ->disableOriginalConstructor()
                ->getMock();
        $mock->expects($this->once())
                ->method('setStringsClass')
                ->with($this->equalTo($data['stringsClass']));

        $mock->load($data);
    }

    public function testGetStringsClass()
    {
        $className = BaseOptions::class;

        $expected = 'test-value';

        $mock = $this->getMockBuilder($className)
                ->setMethods(['load'])
                ->disableOriginalConstructor()
                ->getMock();

        $reflectedClass = new \ReflectionClass($className);
        $property = $reflectedClass->getProperty('stringsClass');
        $property->setAccessible(true);
        $property->setValue($mock, $expected);

        $this->assertEquals($expected, $mock->getStringsClass());
    }

    public function testGetTypeClass()
    {
        $className = BaseOptions::class;

        $expected = 'test-value';

        $mock = $this->getMockBuilder($className)
                ->setMethods(['load'])
                ->disableOriginalConstructor()
                ->getMock();

        $reflectedClass = new \ReflectionClass($className);
        $property = $reflectedClass->getProperty('typeClass');
        $property->setAccessible(true);
        $property->setValue($mock, $expected);

        $this->assertEquals($expected, $mock->getTypeClass());
    }

    public function testSetStringsClass()
    {
        $className = BaseOptions::class;

        $expected = 'test-value';

        $mock = $this->getMockBuilder($className)
                ->setMethods(['load'])
                ->disableOriginalConstructor()
                ->getMock();

        $mock->setStringsClass($expected);

        $reflectedClass = new \ReflectionClass($className);
        $property = $reflectedClass->getProperty('stringsClass');
        $property->setAccessible(true);

        $this->assertEquals($expected, $property->getValue($mock));
    }

    public function testSetTypeClass()
    {
        $className = BaseOptions::class;

        $expected = 'test-value';

        $mock = $this->getMockBuilder($className)
                ->setMethods(['load'])
                ->disableOriginalConstructor()
                ->getMock();

        $mock->setTypeClass($expected);

        $reflectedClass = new \ReflectionClass($className);
        $property = $reflectedClass->getProperty('typeClass');
        $property->setAccessible(true);

        $this->assertEquals($expected, $property->getValue($mock));
    }

}

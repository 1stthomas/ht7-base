<?php

namespace Ht7\Base\Tests;

use \Ht7\Base\ContainerLw;
use \Ht7\Base\Exceptions\ContainerResolvingException;
use \Ht7\Base\Exceptions\EntryNotFoundException;
use \PHPUnit\Framework\TestCase;

class ContainerLwTest extends TestCase
{
    public function testConstruct()
    {
        $className = ContainerLw::class;

        $mock = $this->getMockBuilder($className)
            ->setMethods(['bind'])
            ->disableOriginalConstructor()
            ->getMock();

        $reflectedClass = new \ReflectionClass($className);
        $propBindings = $reflectedClass->getProperty('bindings');
        $propBindings->setAccessible(true);
        $propInstances = $reflectedClass->getProperty('instances');
        $propInstances->setAccessible(true);

        $this->assertNull($propBindings->getValue($mock));
        $this->assertNull($propInstances->getValue($mock));

        $constructor = $reflectedClass->getConstructor();
        $constructor->invoke($mock);

        $this->assertIsArray($propBindings->getValue($mock));
        $this->assertEmpty($propBindings->getValue($mock));
        $this->assertIsArray($propInstances->getValue($mock));
        $this->assertEmpty($propInstances->getValue($mock));
    }
    public function testGetInstance()
    {
        $this->assertInstanceOf(ContainerLw::class, ContainerLw::getInstance());
    }
    public function testGetInstanceSingleton()
    {
        $this->assertSame(ContainerLw::getInstance(), ContainerLw::getInstance());
    }
    public function testBind()
    {
        $className = ContainerLw::class;

        $mock = $this->getMockBuilder($className)
            ->setMethods(['bound'])
            ->disableOriginalConstructor()
            ->getMock();

        $reflectedClass = new \ReflectionClass($className);
        $prop = $reflectedClass->getProperty('bindings');
        $prop->setAccessible(true);
        $prop->setValue($mock, []);

        $mock->bind('ht7/test');

        $this->assertArrayHasKey('ht7/test', $prop->getValue($mock));
        $this->assertNull($prop->getValue($mock)['ht7/test']);

        $mock->bind('ht7/test/exception', \InvalidArgumentException::class);

        $this->assertArrayHasKey('ht7/test/exception', $prop->getValue($mock));
        $this->assertEquals(\InvalidArgumentException::class, $prop->getValue($mock)['ht7/test/exception']);
    }
    public function testBond()
    {
        $className = ContainerLw::class;

        $bindings = ['ht7/test' => null];

        $mock = $this->getMockBuilder($className)
            ->setMethods(['getBindings'])
            ->disableOriginalConstructor()
            ->getMock();
        $mock->expects($this->exactly(3))
            ->method('getBindings')
            ->willReturn($bindings);

        $this->assertIsBool($mock->bound('ht7/test'));
        $this->assertTrue($mock->bound('ht7/test'));
        $this->assertFalse($mock->bound('ht7/test1'));
    }
//    public function testGet()
//    {
//        $className = ContainerLw::class;
//
//        $bindings = ['ht7/test' => 'expected binding'];
//
//        $mock = $this->getMockBuilder($className)
//                ->setMethods(['getBindings'])
//                ->disableOriginalConstructor()
//                ->getMock();
//        $mock->expects($this->exactly(1))
//                ->method('getBindings')
//                ->willReturn($bindings);
//
//        $this->assertEquals($bindings['ht7/test'], $mock->get('ht7/test'));
//    }

    public function testGet()
    {
        $className = ContainerLw::class;

        $bindings = ['ht7/test' => 'expected binding'];

        $mock = $this->getMockBuilder($className)
            ->setMethods(['resolve'])
            ->disableOriginalConstructor()
            ->getMock();
        $mock->expects($this->exactly(1))
            ->method('resolve')
            ->willReturn($bindings['ht7/test']);

        $this->assertEquals($bindings['ht7/test'], $mock->get('ht7/test'));
    }
//    public function testGetExceptionContainer()
//    {
//        $className = ContainerLw::class;
//
//        $excBinding = [
//            'ht7/exc' => function() {
//                throw new \Exception();
//            }
//        ];
//        $errBinding = ['exc/container/psr/container' => ContainerResolvingException::class];
//
//        $mock = $this->getMockBuilder($className)
//                ->setMethods(['has', 'getBindings'])
//                ->disableOriginalConstructor()
//                ->getMock();
//        $mock->expects($this->exactly(1))
//                ->method('has')
//                ->willReturn(true);
//        $mock->expects($this->exactly(2))
//                ->method('getBindings')
////                ->will($this->returnCallback(function() {
//                ->willReturnOnConsecutiveCalls($excBinding, $errBinding);
////                ->willReturnOnConsecutiveCalls($excBinding, $errBinding);
////                ->willReturn($excBinding, $errBinding);
////                ->will($this->returnValueMap([$bindings,]));
////                ->willReturn($bindings);
//
//        $this->expectException(ContainerResolvingException::class);
//
//        $mock->get('ht7/exc');
//    }

    public function testGetExceptionEntryNotFound()
    {
        $className = ContainerLw::class;

        $mock = $this->getMockBuilder($className)
            ->setMethods(['getBindings'])
            ->disableOriginalConstructor()
            ->getMock();
        $mock->expects($this->exactly(2))
            ->method('getBindings')
            ->willReturn([], ['exc/container/psr/notfound' => EntryNotFoundException::class]);

        $this->expectException(EntryNotFoundException::class);

        $mock->get('ht7/not_found');
    }
//    public function testGetBindings
}

<?php

namespace Ht7\Base\Tests\Unit\Validation\Types;

use \Ht7\Base\Validation\Lists\RuleList;
use \Ht7\Base\Validation\Types\AbstractType;
use \Ht7\Base\Validation\Rules\IsArray;
use \Ht7\Base\Validation\Rules\IsInstanceOf;
use \Ht7\Base\Validation\Rules\IsPrimitive;
use \Ht7\Base\Validation\Types\ValidationTypable;
use \PHPUnit\Framework\TestCase;

class AbstractTypeTest extends TestCase
{

//    public function testConstruct()
//    {
//        $className = AbstractType::class;
//        $className2 = ValidationTypable::class;
//        $className3 = RuleList::class;
//
//        $rulesInit = [
//            IsArray::class,
//            IsInstanceOf::class
//        ];
//        $rulesDefault = [
//            IsPrimitive::class
//        ];
//        $rulesMerged = [
//            IsPrimitive::class,
//            IsArray::class,
//            IsInstanceOf::class
//        ];
//
//        $stub = $this->createMock($className3);
//
//        $mock = $this->getMockBuilder($className)
//                ->setMethods(['getDefaults', 'createRuleListFromArray', 'setRuleList'])
//                ->disableOriginalConstructor()
//                ->getMockForAbstractClass();
//
//        $this->assertInstanceOf($className2, $mock);
//
//        $mock->expects($this->once())
//                ->method('getDefaults')
//                ->willReturn($rulesDefault);
//        $mock->expects($this->once())
//                ->method('createRuleListFromArray')
//                ->with($this->equalTo($rulesMerged))
//                ->willReturn($stub);
//        $mock->expects($this->once())
//                ->method('setRuleList')
//                ->with($this->equalTo($stub));
//
//        $reflectedClass = new \ReflectionClass($className);
//        $constructor = $reflectedClass->getConstructor();
//        $constructor->invoke($mock, $rulesInit);
//    }
//
//    public function testConstructWithoutDefaults()
//    {
//        $className = AbstractType::class;
//        $className2 = ValidationTypable::class;
//        $className3 = RuleList::class;
//
//        $rulesInit = [
//            IsArray::class,
//            IsInstanceOf::class
//        ];
//
//        $stub = $this->createMock($className3);
//
//        $mock = $this->getMockBuilder($className)
//                ->setMethods(['getDefaults', 'createRuleListFromArray', 'setRuleList'])
//                ->disableOriginalConstructor()
//                ->getMockForAbstractClass();
//
//        $this->assertInstanceOf($className2, $mock);
//
//        $mock->expects($this->exactly(0))
//                ->method('getDefaults');
//        $mock->expects($this->once())
//                ->method('createRuleListFromArray')
//                ->with($this->equalTo($rulesInit))
//                ->willReturn($stub);
//        $mock->expects($this->once())
//                ->method('setRuleList')
//                ->with($this->equalTo($stub));
//
//        $reflectedClass = new \ReflectionClass($className);
//        $constructor = $reflectedClass->getConstructor();
//        $constructor->invoke($mock, $rulesInit, false);
//    }
//
//    public function testCreateRuleListFromArray()
//    {
//        $className = AbstractType::class;
//
//        $items = [
//            'test1',
//            new \stdClass()
//        ];
//
//        $stub = $this->getMockBuilder($className)
//                ->setMethods(['getDefaults'])
//                ->disableOriginalConstructor()
//                ->getMockForAbstractClass();
//
//        $rL = $stub->createRuleListFromArray($items);
//
//        $this->assertInstanceOf(RuleList::class, $rL);
//
//        $reflectedClass = new \ReflectionClass(RuleList::class);
//        $property = $reflectedClass->getProperty('items');
//        $property->setAccessible(true);
//
//        $this->assertEquals($items, $property->getValue($rL));
//    }

    public function testGetHash()
    {
        $className = AbstractType::class;

        $stub = $this->getMockBuilder($className)
                ->setMethods(['getDefaults'])
                ->disableOriginalConstructor()
                ->getMockForAbstractClass();

        $reflectedClass = new \ReflectionClass($className);
        $property = $reflectedClass->getProperty('type');
        $property->setAccessible(true);
        $property->setValue($stub, 'test_123');

        $this->assertEquals('test_123', $stub->getHash());
    }

//    public function testGetRuleList()
//    {
//        $className = AbstractType::class;
//        $className2 = RuleList::class;
//
//        $stubRl = $this->getMockBuilder($className2)
//                ->setMethods(['get'])
//                ->disableOriginalConstructor()
//                ->getMockForAbstractClass();
//
//        $stub = $this->getMockBuilder($className)
//                ->setMethods(['getDefaults'])
//                ->disableOriginalConstructor()
//                ->getMockForAbstractClass();
//
//        $reflectedClass = new \ReflectionClass($className);
//        $property = $reflectedClass->getProperty('ruleList');
//        $property->setAccessible(true);
//        $property->setValue($stub, $stubRl);
//
//        $this->assertEquals($stubRl, $stub->getRuleList());
//    }
//
//    public function testSetRuleList()
//    {
//        $className = AbstractType::class;
//        $className2 = RuleList::class;
//
//        $stubRl = $this->getMockBuilder($className2)
//                ->setMethods(['get'])
//                ->disableOriginalConstructor()
//                ->getMockForAbstractClass();
//
//        $stub = $this->getMockBuilder($className)
//                ->setMethods(['getDefaults'])
//                ->disableOriginalConstructor()
//                ->getMockForAbstractClass();
//
//        $stub->setRuleList($stubRl);
//
//        $reflectedClass = new \ReflectionClass($className);
//        $property = $reflectedClass->getProperty('ruleList');
//        $property->setAccessible(true);
//
//        $this->assertEquals($stubRl, $property->getValue($stub));
//    }
}

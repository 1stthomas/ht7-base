<?php

namespace Ht7\Base\Tests\Unit\Validation\Lists;

use \Ht7\Base\Validation\Lists\RuleList;
use \PHPUnit\Framework\TestCase;

class RuleListTest extends TestCase
{

    public function testGetReturnCachedObject()
    {
        $className = RuleList::class;

        $items = [
            'rule1' => \InvalidArgumentException::class,
            'rule2' => \stdClass::class
        ];

        $mock = $this->getMockBuilder($className)
                ->setMethods(['load'])
                ->disableOriginalConstructor()
                ->getMock();

        $reflectedClass = new \ReflectionClass($className);
        $property = $reflectedClass->getProperty('items');
        $property->setAccessible(true);
        $property->setValue($mock, $items);

        $actual1 = $mock->get('rule1');

        $this->assertIsObject($actual1);
        $this->assertInstanceOf(\InvalidArgumentException::class, $actual1);

        $actual2 = $mock->get('rule2');

        $this->assertIsObject($actual2);
        $this->assertInstanceOf(\stdClass::class, $actual2);
    }

    public function testForEach()
    {
        $className = RuleList::class;

        $items = [
            'rule1' => \InvalidArgumentException::class,
            'rule2' => \stdClass::class
        ];

        $mock = $this->getMockBuilder($className)
                ->setMethods(['load'])
                ->disableOriginalConstructor()
                ->getMock();

        $reflectedClass = new \ReflectionClass($className);
        $property = $reflectedClass->getProperty('items');
        $property->setAccessible(true);
        $property->setValue($mock, $items);

        $index = 0;

        foreach ($mock as $value) {
            $this->assertIsObject($value);

            switch ($index) {
                case 0:
                    $this->assertInstanceOf(\InvalidArgumentException::class, $value);
                    break;
                case 1:
                    $this->assertInstanceOf(\stdClass::class, $value);
                    break;
                default:
                    break;
            }

            $index++;
        }
    }

}

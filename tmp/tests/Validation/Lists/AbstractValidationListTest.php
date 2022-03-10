<?php

namespace Ht7\Base\Tests\Unit\Validation\Lists;

use \Ht7\Base\Validation\Lists\AbstractValidationList;
use \PHPUnit\Framework\TestCase;

class AbstractValidationListTest extends TestCase
{

    public function testLoad()
    {
        $className = AbstractValidationList::class;

        $items = [
            'rule1' => \InvalidArgumentException::class,
            'rule2' => new \stdClass()
        ];

        $mock = $this->getMockBuilder($className)
                ->setMethods(['get'])
                ->disableOriginalConstructor()
                ->getMock();

        $reflectedClass = new \ReflectionClass($className);
        $property = $reflectedClass->getProperty('items');
        $property->setAccessible(true);
        $property->setValue($mock, []);

        $mock->load($items);

        $itemsStored = $property->getValue($mock);

        $this->assertIsArray($itemsStored);
        $this->assertArrayHasKey('rule1', $items);
        $this->assertArrayHasKey('rule2', $items);
        $this->assertEquals(\InvalidArgumentException::class, $itemsStored['rule1']);
        $this->assertIsObject($itemsStored['rule2']);
    }

}

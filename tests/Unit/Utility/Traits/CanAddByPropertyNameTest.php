<?php

namespace Ht7\Base\Tests;

use \PHPUnit\Framework\TestCase;
use \Ht7\Base\Utility\Traits\CanAddByPropertyName;

/**
 * With phpunit there is no way to add methods to a trait mock. Therefor the
 * method is tested by an anonymous class.
 */
class CanAddByPropertyNameTest extends TestCase
{
    public function testAddByPropertyName()
    {
        $items = [
            'testProperty1' => 'value 1',
            'testProperty2' => 'value 2'
        ];

        $mock = new class
        {

            use CanAddByPropertyName;
            protected $testOne;
            protected $testTwo;

            public function setTestProperty1($test1)
            {
                return $this->testOne = $test1;
            }
            public function setTestProperty2($test2)
            {
                $this->testTwo = $test2;
            }
        };

        $reflectedClass = new \ReflectionClass($mock);
        $testProperty1 = $reflectedClass->getProperty('testOne');
        $testProperty1->setAccessible(true);
        $testProperty2 = $reflectedClass->getProperty('testTwo');
        $testProperty2->setAccessible(true);

        $this->assertNull($testProperty1->getValue($mock));
        $this->assertNull($testProperty2->getValue($mock));

        $mock->addByPropertyName('testProperty1', $items['testProperty1']);
        $mock->addByPropertyName('testProperty2', $items['testProperty2']);

        $this->assertEquals($items['testProperty1'], $testProperty1->getValue($mock));
        $this->assertEquals($items['testProperty2'], $testProperty2->getValue($mock));
    }
    public function testAddByPropertyNameWithException()
    {
        $mock = $this->getMockForTrait(CanAddByPropertyName::class);

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessageMatches('/(U|u)nkown property(.)+unknownProperty/');

        $mock->addByPropertyName('unknownProperty', 'value');
    }
}

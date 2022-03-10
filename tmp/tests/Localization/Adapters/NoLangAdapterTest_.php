<?php

namespace Ht7\Base\Tests\Localization;

use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;
use \Ht7\Base\Localization\Adapters\NoLangAdapter;

class NoLangAdapterTest extends TestCase
{

    public function testContruct()
    {
        $className = NoLangAdapter::class;

        $mock = $this->getMockBuilder($className)
                ->setMethods(['t'])
                ->disableOriginalConstructor()
                ->getMock();

        $reflectedClass = new \ReflectionClass($className);
        $prop = $reflectedClass->getProperty('context');
        $prop->setAccessible(true);

        $this->assertNull($prop->getValue($mock));

        $constructor = $reflectedClass->getConstructor();
        $constructor->invoke($mock);

        $this->assertEquals('no-lang', $prop->getValue($mock));
    }

    public function testT()
    {
        $className = NoLangAdapter::class;

        $str = 'The %s has won a %s.';
        $expected = 'The player has won a cup.';

        $args = [
            'player',
            'cup'
        ];

        $mock = $this->getMockBuilder($className)
                ->setMethods(['t2'])
                ->disableOriginalConstructor()
                ->getMock();

        $this->assertEquals($expected, $mock->t($str, $args));
    }

    public function testTWithMultiple()
    {
        $className = NoLangAdapter::class;

        $str = 'The %2$s has won %1s %3$s cup.';
        $expected = 'The player has won 1 stanley cup.';

        $args = [
            1,
            'player',
            'stanley'
        ];

        $mock = $this->getMockBuilder($className)
                ->setMethods(['t2'])
                ->disableOriginalConstructor()
                ->getMock();

        $this->assertEquals($expected, $mock->t($str, $args));
    }

    public function testT2()
    {
        $className = NoLangAdapter::class;

        $str1 = 'The %s has won %d %s cup.';
        $str2 = 'The %s has won %d %s cups.';

        $args = [
            'player',
            'stanley'
        ];
        $args1 = [
            1,
            'player',
            'stanley'
        ];
        $args2 = [
            2,
            'player',
            'stanley'
        ];

        $mock = $this->getMockBuilder($className)
                ->setMethods(['t'])
                ->disableOriginalConstructor()
                ->getMock();
        $mock->expects($this->exactly(2))
                ->method('t')
                ->withConsecutive([$str1, $args1], [$str2, $args2]);

        $mock->t2($str1, $str2, 1, $args);
        $mock->t2($str1, $str2, 2, $args);
    }

}

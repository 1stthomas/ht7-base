<?php

namespace Ht7\Base\Tests\Exceptions;

use \DOMDocument;
use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;
//use \Ht7\Base\Exceptions\UndefinedConstantException;
use \Ht7\Base\Exceptions\InvalidDatatypeException;
use \Ht7\Base\Exceptions\Utility\Message;
use \Ht7\Base\Tests\EnumTest;

/**
 * Test class for the Enum Base class.
 *
 * @author      Thomas Pluess
 * @since       0.0.1
 * @version     0.0.1
 * @copyright (c) 2019, Thomas Pluess
 */
class MessageTest extends TestCase
{

    public function testCompose()
    {
        $str = Message::compose(
                        "test",
                        InvalidDatatypeException::class,
                        true,
                        ['integer'],
                        [\stdClass::class]
        );

        $this->assertContains('integer', $str);
        $this->assertContains(\stdClass::class, $str);
    }

    /**
     * Test to get a defined constant by comparing the expected value. An undefined
     * constant will throw an exception. This case is tested by this method too.
     */
    public function testGetIndex()
    {
        $c1 = InvalidArgumentException::class;
        $r1 = Message::getIndex($c1);
        $re1 = 'invalid_argument';

        $this->assertEquals($re1, $r1);

        $c2 = EnumTest::class;
        $r2 = Message::getIndex($c2);
        $re2 = 'enum_test';

        $this->assertEquals($re2, $r2);

        $this->expectException(InvalidArgumentException::class);
        Message::getIndex('');
    }

    public function testGetInstances()
    {
        $this->assertEmpty(Message::getInstances([]));

        $instance1 = [InvalidArgumentException::class];

        $this->assertContains(
                InvalidArgumentException::class,
                Message::getInstances($instance1)
        );

        $instances2 = [
            InvalidArgumentException::class,
            EnumTest::class
        ];
        $msg2 = Message::getInstances($instances2);

        $this->assertContains($instances2[0], $msg2);
        $this->assertContains($instances2[1], $msg2);

        $instances4 = [
            InvalidArgumentException::class,
            EnumTest::class,
            DOMDocument::class,
            Message::class
        ];
        $msg4 = Message::getInstances($instances4);

        $this->assertContains($instances4[0], $msg4);
        $this->assertContains($instances4[1], $msg4);
        $this->assertContains($instances4[2], $msg4);
        $this->assertContains($instances4[3], $msg4);
    }

    public function testGetParameters()
    {
        $this->assertContains('undefined', Message::getParameters([], []));

        $this->assertContains(
                'int, string',
                Message::getParameters(
                        ['boolean', 'int', 'string', 'float'],
                        []
                )
        );

        $this->assertContains(
                InvalidArgumentException::class,
                Message::getParameters(
                        [],
                        [EnumTest::class, InvalidArgumentException::class, Message::class]
                )
        );

        $msgBoth = Message::getParameters(
                        ['boolean', 'int', 'float', 'string'],
                        [EnumTest::class, InvalidArgumentException::class, Message::class]
        );

        $this->assertContains(
                InvalidArgumentException::class,
                $msgBoth
        );
        $this->assertContains(
                'int, float, string',
                $msgBoth
        );
    }

    public function testGetPrimitivs()
    {
        $haystack = Message::getPrimitivs(['int', 'string']);

        $this->assertContains('int', $haystack);
        $this->assertContains('string', $haystack);
    }

}

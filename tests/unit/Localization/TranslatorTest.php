<?php

namespace Ht7\Base\Tests\Localization;

use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;
use \Ht7\Base\Localization\TranslationTypes;
use \Ht7\Base\Localization\Translator;

/**
 * Test class for the Enum Base class.
 *
 * @author      Thomas Pluess
 * @since       0.0.1
 * @version     0.0.1
 * @copyright (c) 2019, Thomas Pluess
 */
class TranslatorTest extends TestCase
{

    public function testTranslate()
    {
        $str = Translator::t(TranslationTypes::TRANSLATION_TYPE_SIMPLE, 'A %s test.', ['short'], 'no_context');

        $this->assertContains('short', $str);
        $this->assertContains('test', $str);
    }

    public function testInvalidArgument()
    {
        $this->expectException(InvalidArgumentException::class);

        Translator::t(11111, 'A %s test.', ['short'], 'no_context');
    }

}

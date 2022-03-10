<?php

namespace Ht7\Base\Tests\Localization;

use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;
use \Ht7\Base\Localization\TranslatorOld;

/**
 * Test class for the Enum Base class.
 *
 * @author      Thomas Pluess
 * @since       0.0.1
 * @version     0.0.1
 * @copyright (c) 2019, Thomas Pluess
 */
class TranslatorOldTest extends TestCase
{

    public function testTranslate()
    {
        $str1 = TranslatorOld::t('A %s test.', ['short']);

        $this->assertContains('short', $str1);
        $this->assertContains('test', $str1);

        $str2 = TranslatorOld::t('A %s test.', ['long'], 'with_context');

        $this->assertContains('long', $str2);
        $this->assertContains('test', $str2);

        $str3a = TranslatorOld::t2('A %s new-test.', 'Multiple %s new-tests.', 1, ['I-have-no-context']);

        $this->assertContains('I-have-no-context', $str3a);
        $this->assertContains('new-test.', $str3a);

        $str3b = TranslatorOld::t2('A %s new-test.', 'Multiple %s new-tests.', 2, ['I-have-no-context']);

        $this->assertContains('I-have-no-context', $str3b);
        $this->assertContains('new-tests.', $str3b);

        $str4 = TranslatorOld::t2('A %s last test.', 'Multiple %s last tests.', 2, ['I-have-a-context'], 'with_context');

        $this->assertContains('I-have-a-context', $str4);
        $this->assertContains('Multiple', $str4);
    }

}

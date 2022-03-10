<?php

namespace Ht7\Base\Tests;

use \PHPUnit\Framework\TestCase;
use \Ht7\Base\Utility\Strings;

/**
 * Test class for the Enum Base class.
 *
 * @author      Thomas Pluess
 * @since       0.0.1
 * @version     0.0.1
 * @copyright (c) 2019, Thomas Pluess
 */
class StringsTest extends TestCase
{

    public function testDecamelize()
    {
        $data = [
            'simpleTest' => 'simple_test',
            'easy' => 'easy',
            'HTML' => 'html',
            'simpleXML' => 'simple_xml',
            'PDFLoad' => 'pdf_load',
            'startMIDDLELast' => 'start_middle_last',
            'AString' => 'a_string',
            'Some4Numbers234' => 'some4_numbers234',
            'TEST123String' => 'test123_string',
            'hello_world' => 'hello_world',
            'hello__world' => 'hello__world',
            '_hello_world_' => '_hello_world_',
            'hello_World' => 'hello_world',
            'HelloWorld' => 'hello_world',
            'helloWorldFoo' => 'hello_world_foo',
            'hello-world' => 'hello-world',
            'myHTMLFiLe' => 'my_html_fi_le',
            'aBaBaB' => 'a_ba_ba_b',
            'BaBaBa' => 'ba_ba_ba',
            'libC' => 'lib_c'
        ];

        foreach ($data as $org => $expected) {
            $this->assertEquals($expected, Strings::decamelize($org));
        }
    }

}

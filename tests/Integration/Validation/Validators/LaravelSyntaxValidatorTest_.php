<?php

namespace Ht7\Base\Tests\Integration\Validation\Validators;

use \Ht7\Base\Validation\Validators\MultiValueValidationable;
use \Ht7\Base\Validation\Validators\LaravelSyntaxValidator;
use \PHPUnit\Framework\TestCase;

class LaravelSyntaxValidatorTest extends TestCase
{

    private $object;

    public function setUp()
    {
        $this->object = new LaravelSyntaxValidator([], []);
    }

    protected function tearDown()
    {

    }

    public function testInitialisation()
    {
        $this->assertIsObject($this->object->getList());
        $this->assertIsObject($this->object->getOptions());
        $this->assertInstanceOf(MultiValueValidationable::class, $this->object);

        $this->assertIsString($this->object->getHash());
        $this->assertNotEmpty($this->object->getHash());
    }

//    public function testValidate()
//    {
//
//    }
}

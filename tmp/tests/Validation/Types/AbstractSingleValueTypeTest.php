<?php

namespace Ht7\Base\Tests\Unit\Validation\Types;

use \Ht7\Base\Validation\Options\BaseOptions;
use \Ht7\Base\Validation\Rules\IsArray;
use \Ht7\Base\Validation\Rules\IsInstanceOf;
use \Ht7\Base\Validation\Types\AbstractSingleValueType;
use \Ht7\Base\Validation\Types\AbstractType;
use \Ht7\Base\Validation\Types\SingleValueValidationable;
use \Ht7\Base\Validation\Types\Options\AbstractTypeOptions;
use \PHPUnit\Framework\TestCase;

class AbstractSingleValueTypeTest extends TestCase
{

    public function testConstruct()
    {
        $className = AbstractSingleValueType::class;
        $className2 = AbstractType::class;
        $className3 = SingleValueValidationable::class;

        $mock = $this->getMockBuilder($className)
                ->setMethods(['validate'])
                ->disableOriginalConstructor()
                ->getMockForAbstractClass();

        $this->assertInstanceOf($className2, $mock);
        $this->assertInstanceOf($className3, $mock);
    }

    public function testValidateAllPassed()
    {
        $className = AbstractSingleValueType::class;
        $className2 = IsArray::class;
        $className3 = IsInstanceOf::class;

        $stub1 = $this->getMockBuilder($className2)
                ->setMethods(['check'])
                ->disableOriginalConstructor()
                ->getMock();
        $stub1->expects($this->once())
                ->method('check')
                ->willReturn(true);

        $stub2 = $this->getMockBuilder($className3)
                ->setMethods(['check'])
                ->disableOriginalConstructor()
                ->getMock();
        $stub2->expects($this->once())
                ->method('check')
                ->willReturn(true);

        $rL = [
            $stub1,
            $stub2
        ];

        $mock = $this->getMockBuilder($className)
                ->setMethods(['getList'])
                ->disableOriginalConstructor()
                ->getMockForAbstractClass();
        $mock->expects($this->once())
                ->method('getList')
                ->willReturn($rL);

        $this->assertTrue($mock->validate('test value', 'variable name', []));
    }

    public function testValidateFailed()
    {
        $className = AbstractSingleValueType::class;
        $className2 = IsArray::class;
        $className3 = IsInstanceOf::class;

        $baseOptions = $this->getMockBuilder(BaseOptions::class)
                ->setMethods(['getStopOnFail'])
                ->disableOriginalConstructor()
                ->getMock();
        $baseOptions->expects($this->once())
                ->method('getStopOnFail')
                ->willReturn(false);

        $options = $this->getMockBuilder(AbstractTypeOptions::class)
                ->setMethods(['getBaseOptions'])
                ->disableOriginalConstructor()
                ->getMockForAbstractClass();
        $options->expects($this->once())
                ->method('getBaseOptions')
                ->willReturn($baseOptions);

        $stub1 = $this->getMockBuilder($className2)
                ->setMethods(['check'])
                ->disableOriginalConstructor()
                ->getMock();
        $stub1->expects($this->once())
                ->method('check')
                ->willReturn(true);

        $stub2 = $this->getMockBuilder($className3)
                ->setMethods(['check'])
                ->disableOriginalConstructor()
                ->getMock();
        $stub2->expects($this->once())
                ->method('check')
                ->willReturn(false);

        $rL = [
            'IsArray' => $stub1,
            'IsInstanceOf' => $stub2
        ];

        $mock = $this->getMockBuilder($className)
                ->setMethods(['getList', 'handleValidationFail'])
                ->disableOriginalConstructor()
                ->getMockForAbstractClass();
        $mock->expects($this->once())
                ->method('getList')
                ->willReturn($rL);
        $mock->expects($this->once())
                ->method('handleValidationFail')
                ->with(
                        $this->equalTo('test value'),
                        $this->equalTo('variable name'),
                        $this->equalTo('IsInstanceOf'),
                        $this->equalTo($options)
        );

        $this->assertFalse($mock->validate('test value', 'variable name', $options));
    }

    public function testValidateFailedWithStop()
    {
        $className = AbstractSingleValueType::class;
        $className2 = IsArray::class;
        $className3 = IsInstanceOf::class;

        $baseOptions = $this->getMockBuilder(BaseOptions::class)
                ->setMethods(['getStopOnFail'])
                ->disableOriginalConstructor()
                ->getMock();
        $baseOptions->expects($this->once())
                ->method('getStopOnFail')
                ->willReturn(true);

        $options = $this->getMockBuilder(AbstractTypeOptions::class)
                ->setMethods(['getBaseOptions'])
                ->disableOriginalConstructor()
                ->getMockForAbstractClass();
        $options->expects($this->once())
                ->method('getBaseOptions')
                ->willReturn($baseOptions);

        $stub1 = $this->getMockBuilder($className2)
                ->setMethods(['check'])
                ->disableOriginalConstructor()
                ->getMock();
        $stub1->expects($this->once())
                ->method('check')
                ->willReturn(false);

        $stub2 = $this->getMockBuilder($className3)
                ->setMethods(['check'])
                ->disableOriginalConstructor()
                ->getMock();
        $stub2->expects($this->exactly(0))
                ->method('check');

        $rL = [
            'IsArray' => $stub1,
            'IsInstanceOf' => $stub2
        ];

        $mock = $this->getMockBuilder($className)
                ->setMethods(['getList', 'handleValidationFail'])
                ->disableOriginalConstructor()
                ->getMockForAbstractClass();
        $mock->expects($this->once())
                ->method('getList')
                ->willReturn($rL);
        $mock->expects($this->once())
                ->method('handleValidationFail')
                ->with(
                        $this->equalTo('test value'),
                        $this->equalTo('variable name'),
                        $this->equalTo('IsArray'),
                        $this->equalTo($options)
        );

        $this->assertFalse($mock->validate('test value', 'variable name', $options));
    }

}

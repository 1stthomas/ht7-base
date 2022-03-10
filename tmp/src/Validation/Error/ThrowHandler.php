<?php

namespace Ht7\Kernel\Validation\Error;

use \InvalidArgumentException;
use \Ht7\Kernel\Validation\Options\Base as Options;
use \Ht7\Kernel\Validation\Types\AbstractType as ValidationType;

/**
 * Description of ThrowHandler
 *
 * @author Thomas Pluess
 */
class ThrowHandler
{

    protected $defaultExceptionClass;
    protected $exceptionClass;

    public function __construct(ValidationType $type, Options $options)
    {
        $this->defaultExceptionClass = InvalidArgumentException::class;

        $this->setExceptionClass($options);
    }

    public function setExceptionClass(Options $options)
    {
        if (method_exists($options, 'getErrorOptions')) {

        }
    }

    public function throwException(string $class, $msg = '')
    {
        if (empty($msg)) {

        } else {
            throw new $class($msg);
        }
    }

}

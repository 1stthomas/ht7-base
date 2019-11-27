<?php

namespace Ht7\Base\Exceptions;

use \Exception;
use \Throwable;

/**
 * Description of UndefinedPropertyException
 *
 * @author Thomas Pluess
 */
class UndefinedPropertyException extends Exception
{

    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}

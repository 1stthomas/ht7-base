<?php

namespace Ht7\Base;

use \Ht7\Base\Exceptions\UndefinedConstantException;
use \Ht7\Base\Utility\Traits\CanRestrictInexVariables;

/**
 * This is a basic implementation of a Enum like class, which has some main
 * functionallity from the Java Enum.
 *
 * @author  Thomas Pluess
 * @link    https://stackoverflow.com/questions/254514/php-and-enumerations
 */
abstract class Enum
{

    use CanRestrictInexVariables;

    /**
     * Get the value of a specific constant.
     *
     * This method throws an <code>UndefinedConstantException</code> if a constant
     * could not be found.
     *
     * @param   string  $name       The constant name. This value will automatically
     *                              transformed to uppercase letters.
     * @return  mixed               The constant value, if there has been found one with
     *                              the given name, otherwise an exception.
     * @throws  UndefinedConstantException
     */
    public static function getConstant($name)
    {
        $constant = constant('static::' . strtoupper($name));

        if ($constant === null) {
            $message = sprintf('Undefined constant %s', $name);

            throw new UndefinedConstantException($message);
        }

        return $constant;
    }

}

<?php

namespace Ht7\Base\Exceptions;

use \InvalidArgumentException;
use \Ht7\Base\Exceptions\Utility\Message;

/* * This exception should be thrown if a method parameter is not of the expected
 * datatype and/or class.
 *
 * @author Thomas Pluess
 */

class InvalidDatatypeException extends InvalidArgumentException
{

    /**
     * Create an instance of the InvalidDatatypeException.
     *
     * @param   string  $name           The name of the invalid parameter.
     * @param   mixed   $found          The invalid parameter.
     * @param   array   $primitiv       Indexed array of allowed primitiv datatypes.
     * @param   array   $instances      Indexed array of allowed classes.
     */
    public function __construct(string $name, $found = null, array $primitiv = [], array $instances = [])
    {
        parent::__construct(
                Message::compose(
                        $name,
                        get_class(),
                        $found,
                        $primitiv,
                        $instances
                )
        );
    }

}

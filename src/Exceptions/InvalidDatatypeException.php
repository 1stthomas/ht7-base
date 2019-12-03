<?php

namespace Ht7\Base\Exceptions;

use \InvalidArgumentException;
use \Ht7\Base\Exceptions\Utility\Message;

/**
 * Description of UndefinedPropertyException
 *
 * @author Thomas Pluess
 */
class InvalidDatatypeException extends InvalidArgumentException
{

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

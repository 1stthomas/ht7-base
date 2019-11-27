<?php

namespace Ht7\Base\Utility\Traits;

use \InvalidArgumentException;

/**
 *
 * @author Thomas Pluess
 */
trait CanRestrictInexVariables
{

    public function __set($name, $value)
    {
        $e = sprintf('Unsupported property %s', $name);

        throw new InvalidArgumentException($e);
    }

}

<?php

namespace Ht7\Base\Validation\Types;

use \Ht7\Base\Validation\Types\ValidationTypable;

/**
 *
 * @author      Thomas Pluess
 * @version     0.0.1
 * @since       0.0.1
 */
interface SingleValueValidationable extends ValidationTypable
{

    /**
     *
     * @param   mixed   $value                  The value to validate.
     * @param   string  $name                   The variable name.
     * @param   type $options
     * @return  boolean                         True if all checks passed.
     */
    public function validate($value, string $name, $options);
}

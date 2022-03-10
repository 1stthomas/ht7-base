<?php

namespace Ht7\Base\Validation\Types;

use \Ht7\Base\Validation\Types\ValidationTypable;

/**
 *
 * @author      Thomas Pluess
 * @version     0.0.1
 * @since       0.0.1
 */
interface MultiValueValidationable extends ValidationTypable
{

    public function validate(array $values, array $types, $options);
}

<?php

namespace Ht7\Base\Validation\Types;

use \Ht7\Base\Lists\Hashable;

/**
 *
 * @author      Thomas Pluess
 * @version     0.0.1
 * @since       0.0.1
 */
interface ValidationTypable extends Hashable
{

    /**
     * Handle defined tasks after a validation has failed.
     *
     * This method is called after a validation check has failed.
     *
     * @param   mixed   $value              The invalid value.
     * @param   string  $name
     * @param   string  $check
     * @param   type $options
     * @return  void
     */
    public function handleValidationFail($value, string $name, string $check, $options);
}

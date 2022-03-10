<?php

namespace Ht7\Base\Validation\Rules;

use \Ht7\Base\Validation\Options\Base as Options;

/**
 *
 * @author Thomas Pluess
 */
interface SingleValueRulable
{

    /**
     * Check a value against a defined rule.
     *
     * @param   mixed   $value              The value to check.
     * @param   Options $options            The validation options for the
     *                                      specified type.
     * @return  boolean                     True if the check passed successfully.
     */
    public function check($value, $options);
}

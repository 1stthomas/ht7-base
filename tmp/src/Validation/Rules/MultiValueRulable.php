<?php

namespace Ht7\Base\Validation\Rules;

use \Ht7\Base\Validation\Options\Base as Options;

/**
 *
 * @author Thomas Pluess
 */
interface MultiValueRulable
{

    /**
     * Check a value against a defined rule.
     *
     * @param   array   $values             The values with the specific value to check.
     * @param   string  $name               The array key of the value to check.
     * @param   Options $options            The validation options for the
     *                                      specified type.
     * @return  boolean                     True if the check passed successfully.
     */
    public function check(array $values, string $name, $options);
}

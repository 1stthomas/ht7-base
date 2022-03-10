<?php

namespace Ht7\Base\Validation\Rules;

use \Ht7\Base\Validation\Rules\MultiValueRulable;

/**
 * Description of InstOf
 *
 * @author Thomas Pluess
 */
class IsRequired implements MultiValueRulable
{

    /**
     * Check the value if it is a PHP object.
     *
     * {@inheritdoc}
     */
    public function check(array $values, string $name, $options)
    {
        return !empty($values[$name]);
    }

}

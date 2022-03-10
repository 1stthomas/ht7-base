<?php

namespace Ht7\Base\Validation\Rules;

use \Ht7\Base\Validation\Rules\SingleValueRulable;

/**
 * Description of InstOf
 *
 * @author Thomas Pluess
 */
class IsArray implements SingleValueRulable
{

    /**
     * Check if all of the characters are alphabetic or numeric.
     *
     * {@inheritdoc}
     */
    public function check($value, $options)
    {
        return is_array($value);
    }

}

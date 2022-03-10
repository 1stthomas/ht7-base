<?php

namespace Ht7\Base\Validation\Rules;

use \Ht7\Base\Validation\Rules\SingleValueRulable;

/**
 * Description of InstOf
 *
 * @author Thomas Pluess
 */
class IsAlphabetical implements SingleValueRulable
{

    /**
     * Check if all of the characters are alphabetic.
     *
     * {@inheritdoc}
     */
    public function check($value, $options)
    {
        return ctype_alpha($value);
    }

}

<?php

namespace Ht7\Base\Validation\Rules;

use \Ht7\Base\Validation\Options\Base as Options;
use \Ht7\Base\Validation\Rules\SingleValueRulable;

/**
 * Description of InstOf
 *
 * @author Thomas Pluess
 */
class IsObject implements SingleValueRulable
{

    /**
     * Check the value if it is a PHP object.
     *
     * {@inheritdoc}
     */
    public function check($value, $options)
    {
        return is_object($value);
    }

}

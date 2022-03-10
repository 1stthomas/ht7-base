<?php

namespace Ht7\Base\Validation\Rules;

use \Ht7\Base\Validation\Rules\SingleValueRulable;

/**
 * Description of InstOf
 *
 * @author Thomas Pluess
 */
class IsInstanceOf implements SingleValueRulable
{

    /**
     * Check if the value is an instance of a given class.
     *
     * {@inheritdoc}
     */
    public function check($value, $options)
    {
        /* @var $options \Ht7\Kernel\Validation\Options\InstOf */
        return is_a($value, $options->getInstance(), true);
    }

}

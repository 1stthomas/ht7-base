<?php

namespace Ht7\Base\Validation\Rules;

use \Ht7\Base\Validation\Options\BaseTypeOptionable;
use \Ht7\Base\Validation\Rules\SingleValueRulable;

/**
 * Description of InstOf
 *
 * @author Thomas Pluess
 */
class IsPrimitive implements SingleValueRulable
{

    /**
     * Check if the value is one of the defined values.
     *
     * The haystack to check against will be taken from <code>$options->getValuesIncluded()</code>.
     *
     * {@inheritdoc}
     */
    public function check($value, BaseTypeOptionable $options)
    {
        /* @var $options Ht7\Base\Validation\Types\Options\ValuesIncluded */
        return in_array($value, $options->getValuesIncluded());
    }

}

<?php

namespace Ht7\Base\Validation\Rules;

use \Ht7\Base\Validation\Rules\SingleValueRulable;

/**
 * Description of InstOf
 *
 * @author Thomas Pluess
 */
class IsDateTime implements SingleValueRulable
{

    /**
     * Check if all of the characters are alphabetic or numeric.
     *
     * {@inheritdoc}
     */
    public function check($value, $options)
    {
        // @see https://www.php.net/manual/de/function.checkdate.php#113205
        $dt = DateTime::createFromFormat($options->getFormat(), $value);

        return $dt && $dt->format($options->getFormat()) == $value;
    }

}

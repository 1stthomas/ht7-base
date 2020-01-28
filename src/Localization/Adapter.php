<?php

namespace Ht7\Base\Localization;

/**
 * This class defines the needed translation methods.
 *
 * All methods map to the simple translation without context or a plural.
 *
 * @author Thomas Plüss
 */
class Adapter implements Adapterable
{

    /**
     * @override
     */
    public function t1($str, array $args = [])
    {
        array_unshift($args, $str);

        return call_user_func_array('sprintf', $args);
    }

    /**
     * @override
     */
    public function t2($str1, $str2, $count = 1, array $args = [])
    {
        if ($count > 1) {
            array_unshift($args, $str2);

            return call_user_func_array('sprintf', $args);
        } else {
            return $this->t1($str1, $args);
        }
    }

    /**
     * @override
     */
    public function t3($context, $str, array $args = [])
    {
        return $this->t1($str, $args);
    }

    /**
     * @override
     */
    public function t4($context, $str1, $str2, $count = 1, array $args = [])
    {
        return $this->t2($str1, $str2, $count, $args);
    }

}

<?php

namespace Ht7\Base\Localization\Adapters;

use \Ht7\Base\Localization\Adapters\AbstractAdapter;

/**
 * This class defines the needed translation methods.
 *
 * All methods map to the simple translation without context or a plural.
 *
 * @author Thomas Plüss
 */
class NoLangAdapter extends AbstractAdapter
{

    public function __construct()
    {
        parent::__construct('no-lang');
    }

    /**
     * {@inheritdoc}
     */
    public function t($str, array $args = [])
    {
        array_unshift($args, $str);

        return call_user_func_array('sprintf', $args);
    }

    /**
     * {@inheritdoc}
     */
    public function t2($str1, $str2, $count = 1, array $args = [])
    {
        if ($count > 1) {
            $str = $str2;
        } else {
            $str = $str1;
        }

        array_unshift($args, $count);

        return $this->t($str, $args);
    }

}

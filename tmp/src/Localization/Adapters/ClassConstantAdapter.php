<?php

namespace Ht7\Base\Localization\Adapters;

use \Ht7\Base\Localization\Adapters\AbstractAdapter;
use \Ht7\Base\Storage\Models\StorageModelable;

/**
 * Description of ClassSourceAdapter
 *
 * @author Thomas Pluess
 */
class ClassConstantAdapter extends AbstractAdapter
{

    public function __construct(string $class)
    {
        parent::__construct($class);
    }

    /**
     * {@inheritdoc}
     */
    public function t($str, array $args = [], $context = '')
    {
        array_unshift($args, $str);

        return call_user_func_array('sprintf', $args);
    }

    /**
     * {@inheritdoc}
     */
    public function t2($str1, $str2, $count = 1, array $args = [], $context = '')
    {
        if ($count > 1) {
            array_unshift($args, $str2);

            return call_user_func_array('sprintf', $args);
        } else {
            return $this->t1($str1, $args);
        }
    }

}

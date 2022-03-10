<?php

namespace Ht7\Base\Validation\Types;

use \Ht7\Base\Validation\Rules\IsInstanceOf;
use \Ht7\Base\Validation\Rules\IsObject;
use \Ht7\Base\Validation\Types\AbstractSingleValueType;

/**
 * Description of InstanceOf
 *
 * @author Thomas Pluess
 */
class InstOf extends AbstractSingleValueType
{

    public function createListFromArray(array $elements)
    {
        ;
    }

    public function createOptionsFromArray(array $options)
    {
        ;
    }

    public function getDefaults()
    {
        return [
            IsObject::class,
            IsInstanceOf::class
        ];
    }

}

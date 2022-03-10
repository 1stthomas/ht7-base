<?php

namespace Ht7\Base\Validation\Types;

use \Ht7\Base\Validation\Rules\IsPrimitive;
use \Ht7\Base\Validation\Types\AbstractSingleValueType;

/**
 * Description of InstanceOf
 *
 * @author Thomas Pluess
 */
class Accepted extends AbstractSingleValueType
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
            IsPrimitive::class
        ];
    }

}

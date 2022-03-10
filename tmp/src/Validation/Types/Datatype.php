<?php

namespace Ht7\Base\Validation\Types;

use \Ht7\Base\Validation\Types\Options\DatatypeOptions;
use \Ht7\Base\Validation\Rules\IsPrimitive;
use \Ht7\Base\Validation\Rules\IsInstanceOf;
use \Ht7\Base\Validation\Types\AbstractSingleValueType;

/**
 * Description of InstanceOf
 *
 * @author Thomas Pluess
 */
class Datatype extends AbstractSingleValueType
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
            IsPrimitive::class,
            IsInstanceOf::class
        ];
    }

    public function validate($value, string $name, $options)
    {
        /* @var $options DatatypeOptions */
        $primitives = $options->getPrimitives();

        if (!empty($options->getPrimitives())) {
//            $this->get
        }
    }

}

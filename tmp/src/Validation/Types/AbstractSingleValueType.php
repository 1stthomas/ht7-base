<?php

namespace Ht7\Base\Validation\Types;

use \Ht7\Base\Validation\Types\AbstractType;
use \Ht7\Base\Validation\Types\SingleValueValidationable;

//use \Ht7\Base\Validation\Options\Base as Options;

/**
 * Description of InstanceOf
 *
 * @author Thomas Pluess
 */
abstract class AbstractSingleValueType extends AbstractType implements SingleValueValidationable
{

    /**
     * {@inheritdoc}
     */
    public function validate($value, string $name, $options)
    {
        $result = true;

        /* @var $rule Ht7\Base\Validation\Rules\Rulable */
        foreach ($this->getList() as $key => $rule) {
            if (!$rule->check($value, $options)) {
                $result = false;

                $this->handleValidationFail($value, $name, $key, $options);

                if ($options->getBaseOptions()->getStopOnFail()) {
                    return false;
                }
            }
        }

        return $result;
    }

}

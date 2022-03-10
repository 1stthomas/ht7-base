<?php

namespace Ht7\Base\Validation\Types;

use \Ht7\Base\Validation\AbstractValidationContainer;
use \Ht7\Base\Validation\Types\ValidationTypable;

/**
 * Description of Abstract Type
 *
 * @author      Thomas Pluess
 * @version     0.0.1
 * @since       0.0.1
 */
abstract class AbstractType extends AbstractValidationContainer implements ValidationTypable
{

    /**
     * @var     int
     */
    protected $type;

    /**
     * {@inheritdoc}
     */
    public function getHash()
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function handleValidationFail($value, string $name, string $check, $options)
    {
//        if ($options->getBaseOptions()->getThrowOnFail()) {
//
//        }
    }

}

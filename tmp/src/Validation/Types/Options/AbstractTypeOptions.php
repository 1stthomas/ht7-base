<?php

namespace Ht7\Base\Validation\Types\Options;

use \Ht7\Base\Models\AbstractTransLoadableModel;
use \Ht7\Base\Validation\Options\BaseOptionable;
use \Ht7\Base\Validation\Options\BaseTypeOptionable;

/**
 * Base validation option class. This class is a model of all base validation
 * options.
 *
 * @author      Thomas Pluess
 * @version     0.0.1
 * @since       0.0.1
 */
class AbstractTypeOptions extends AbstractTransLoadableModel implements BaseTypeOptionable
{

    /**
     * These options are valid for all validation types.
     *
     * @var     BaseOptionable                  The validator options.
     */
    protected $base;

    /**
     * {@inheritdoc}
     */
    public function getBaseOptions()
    {
        return $this->base;
    }

    /**
     * {@inheritdoc}
     */
    public function setBaseOptions(BaseOptionable $options)
    {
        $this->base = $options;
    }

}

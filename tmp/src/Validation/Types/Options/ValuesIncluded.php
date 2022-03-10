<?php

namespace Ht7\Base\Validation\Types\Options;

use \Ht7\Base\Validation\Types\Options\AbstractTypeOptions;

/**
 * Description of InstOf
 *
 * @author Thomas Pluess
 */
class ValuesIncluded extends AbstractTypeOptions
{

    /**
     *
     * @var type
     */
    protected $valuesIncluded;

    public function getValuesIncluded()
    {
        return $this->valuesIncluded;
    }

    public function setValuesIncluded($valuesIncluded)
    {
        $this->valuesIncluded = $valuesIncluded;
    }

}

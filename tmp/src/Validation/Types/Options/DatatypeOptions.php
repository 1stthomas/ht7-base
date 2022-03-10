<?php

namespace Ht7\Base\Validation\Types\Options;

use \Ht7\Base\Validation\Types\Options\AbstractTypeOptions;

/**
 * Description of InstOf
 *
 * @author Thomas Pluess
 */
class DatatypeOptions extends AbstractTypeOptions
{

    /**
     * @var     array                   Assoc array of classes or instances.
     */
    protected $instances;

    /**
     *
     * @var     array
     */
    protected $primitives;

    public function __construct(array $data = [])
    {
        $transformations = [
            'obj' => 'instance',
            'object' => 'instance',
            'objs' => 'instances',
            'objects' => 'instances',
        ];

        parent::__construct($data, $transformations);
    }

    public function getPrimitives()
    {
        return $this->primitives;
    }

    public function getInstances()
    {
        return $this->instance;
    }

    public function setPrimitives($primitives)
    {
        $this->primitives = $primitives;
    }

    public function setInstances(array $instances)
    {
        $this->instances = $instances;
    }

}

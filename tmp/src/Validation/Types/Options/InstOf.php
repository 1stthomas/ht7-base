<?php

namespace Ht7\Base\Validation\Types\Options;

use \Ht7\Base\Validation\Types\Options\AbstractTypeOptions;

/**
 * Description of InstOf
 *
 * @author Thomas Pluess
 */
class InstOf extends AbstractTypeOptions
{

    /**
     *
     * @var type
     */
    protected $class;
    protected $instance;

    public function __construct(array $data = [])
    {
        $transformations = [
            'obj' => 'instance',
            'object' => 'instance'
        ];

        parent::__construct($data, $transformations);
    }

    public function getClass()
    {
        return $this->class;
    }

    public function getInstance()
    {
        return $this->instance;
    }

    public function setClass($class)
    {
        $this->class = $class;
    }

    public function setInstance($instance)
    {
        $this->instance = $instance;
    }

}

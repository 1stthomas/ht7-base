<?php

namespace Ht7\Base\Models;

use \Ht7\Base\Models\TransLoadable;
use \Ht7\Base\Utility\Traits\CanAddByPropertyName;

/**
 * Base model.
 *
 * @author      Thomas Pluess
 * @version     0.0.1
 * @since       0.0.1
 */
abstract class AbstractTransLoadableModel implements TransLoadable
{

    use CanAddByPropertyName;

    protected $transformations;

    public function __construct(array $data = [], array $transformations = [])
    {
        $this->setTransformations($transformations);

        $this->load($data);
    }

    public function getTransformations()
    {
        return $this->transformations;
    }

    public function load(array $data)
    {
        $transformations = $this->getTransformations();

        foreach ($data as $name => $value) {
            if (array_key_exists($name, $transformations)) {
                $name = $transformations[$name];
            }

            $this->addByPropertyName($name, $value);
        }
    }

    public function setTransformations(array $transformations)
    {
        $this->transformations = $transformations;
    }

}

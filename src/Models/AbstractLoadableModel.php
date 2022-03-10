<?php

namespace Ht7\Base\Models;

use \Ht7\Base\Models\Loadable;
use \Ht7\Base\Utility\Traits\CanAddByPropertyName;

/**
 * Base model.
 *
 * @author      Thomas Pluess
 * @version     0.0.1
 * @since       0.0.1
 */
abstract class AbstractLoadableModel implements Loadable
{

    use CanAddByPropertyName;

    public function __construct(array $data = [])
    {
        $this->load($data);
    }

    public function load(array $data)
    {
        foreach ($data as $name => $value) {
            $this->addByPropertyName($name, $value);
        }
    }

}

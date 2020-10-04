<?php

namespace Ht7\Base\Utility\Traits;

/**
 * Implementors of this trait are able to load their variables generic. This
 * requires set methods for every property.
 *
 * @author Thomas Pluess
 */
trait CanAddByPropertyName
{

    public function addByPropertyName($name, $value)
    {
        $method = 'set' . ucfirst($name);

        if (is_callable([$this, $method])) {
            $this->$method($value);
        } else {
            throw new \InvalidArgumentException('Unkown property: ' . $name);
        }
    }

}

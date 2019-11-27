<?php

namespace Ht7\Base\Utility\Traits;

/**
 *
 * @author Thomas Plüss
 */
trait CanLoadByGetMethod
{

    public function load(array $data)
    {
        foreach ($data as $name => $value) {
            $methodName = 'set' . ucfirst($name);

            if (method_exists($this, $methodName)) {
                $this->$methodName($value);
            } else {
                $this->$name = $value;
            }
        }
    }

}

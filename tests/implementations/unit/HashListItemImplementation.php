<?php

namespace Ht7\Base\Tests\Implementations\Unit;

use \Ht7\Base\Lists\Hashable;

/**
 * Description of EnumImplementation
 *
 * @author Thomas Pluess
 */
class HashListItemImplementation implements Hashable
{

    protected $hash;
    protected $value;

    public function __construct($hash, $value = '')
    {
        $this->setHash($hash);
        $this->setValue($value);
    }

    public function getHash()
    {
        return $this->hash;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setHash($hash)
    {
        $this->hash = $hash;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

}

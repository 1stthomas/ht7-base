<?php

namespace Ht7\Base\Tests\Implementations;

use Ht7\Base\ObjectRestricted;

class ObjectRestrictedImplementation extends ObjectRestricted
{

    protected $firstName;
    protected $name;

    public function __construct($data)
    {
        parent::__construct($data);
    }

}

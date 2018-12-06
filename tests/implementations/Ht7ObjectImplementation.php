<?php

namespace Ht7\Tests\Base\Implementations;

use Ht7\Base\Ht7Object;

class Ht7ObjectImplementation extends Ht7Object
{
    protected $name;
    
    public function __construct($name)
    {
        $this->name = $name;
        
        parent::__construct();
    }
}

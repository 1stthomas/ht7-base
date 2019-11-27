<?php

namespace Ht7\Base\Tests\Implementations\Unit;

use \Ht7\Base\Utility\Interfaces\ItemListable;

//use \Ht7\Base\Lists\AbstractItemList;

/**
 * Description of EnumImplementation
 *
 * @author 1stthomas
 */
class ItemImplementation implements ItemListable
{

    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getIdentifier()
    {
        return $this->name;
    }

}

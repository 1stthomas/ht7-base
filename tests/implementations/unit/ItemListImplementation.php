<?php

namespace Ht7\Base\Tests\Implementations\Unit;

use \Ht7\Base\Lists\ItemList;
use \Ht7\Base\Tests\Implementations\Unit\ItemImplementation;

//use \Ht7\Base\Lists\AbstractItemList;

/**
 * Description of EnumImplementation
 *
 * @author 1stthomas
 */
class ItemListImplementation extends ItemList
{

    public function __construct()
    {
        $item1 = new ItemImplementation('test001');
        $this->addItem($item1);
        $item2 = new ItemImplementation('test002');
        $this->addItem($item2);
    }

}

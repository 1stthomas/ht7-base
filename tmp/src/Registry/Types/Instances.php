<?php

namespace Ht7\Base\Registry\Types;

use \Ht7\Base\Lists\ItemList;

/**
 * Description of Classes
 *
 * @author Thomas Pluess
 */
class Instances extends ItemList
{

    public function add($item)
    {
        if (!is_object($item)) {

        }

        $this->items[get_class($item)] = $item;

        return $this;
    }

}

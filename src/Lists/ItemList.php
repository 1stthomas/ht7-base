<?php

namespace Ht7\Base\Lists;

/**
 * The AbstractItemList can be handled as an indexed array. It is accessable by
 * the foreach loop.
 *
 * @author Thomas Pluess
 */
class ItemList extends AbstractItemList
{

    /**
     * @Overriden
     */
    public function add($item)
    {
        $this->items[] = $item;
    }

}

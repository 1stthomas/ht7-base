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

    public function addItem($item)
    {
        $this->items[] = $item;
    }

    /**
     * Check if the item which matches the compare value is present in the
     * current item list.
     *
     * @param   mixed   $compare         The compare value.
     */
    public function hasItem($compare)
    {
        return in_array($compare, $this->items);
    }

}

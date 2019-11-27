<?php

namespace Ht7\Base\Lists;

use \ArrayIterator;
use \IteratorAggregate;
use \Ht7\Base\Utility\Interfaces\ItemListable;

/**
 * The AbstractItemList can be handled as an indexed array. It is accessable by
 * the foreach loop.
 *
 * @author Thomas Pluess
 */
class ItemList extends AbstractItemList
{

    protected $items = [];

    public function addItem(ItemListable $item)
    {
        $this->items[$item->getIdentifier()] = $item;
    }

    /**
     * Get the item which meets the compare value.
     *
     * @param   mixed   $identifier         The compare value.
     */
    public function getItem($identifier)
    {
        return $this->items[$identifier];
    }

    /**
     * Check if the item which matches the compare value is present in the
     * current item list.
     *
     * @param   mixed   $identifier         The compare value.
     */
    public function hasItem($identifier)
    {
        return isset($this->items[$identifier]);
    }

}

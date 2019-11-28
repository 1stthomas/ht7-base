<?php

namespace Ht7\Base\Lists;

use \InvalidArgumentException;
use \Ht7\Base\Utility\Interfaces\Hashable;

/**
 * The AbstractItemList can be handled as an indexed array. It is accessable by
 * the foreach loop.
 *
 * @author Thomas Pluess
 */
class HashList extends AbstractItemList
{

    protected $items = [];

    /**
     *
     * @param   Hashable    $item
     * @throws  InvalidArgumentException
     */
    public function addItem($item)
    {
        if ($item instanceof Hashable) {
            $this->items[$item->getHash()] = $item;
        } else {
            // @todo: generalize the validation..
            $msg = 'The item has to be an implementation of the ItemListable interface, found %s';
            $e = sprintf($msg, gettype($item));

            throw new InvalidArgumentException($e);
        }
    }

    /**
     * Get the item which meets the compare value.
     *
     * @param   mixed   $hash               The compare value.
     */
    public function getItem($hash)
    {
        return $this->items[$hash];
    }

    /**
     * Check if the item which matches the compare value is present in the
     * current item list.
     *
     * @param   mixed   $hash               The compare value.
     */
    public function hasItem($hash)
    {
        return isset($this->items[$hash]);
    }

}

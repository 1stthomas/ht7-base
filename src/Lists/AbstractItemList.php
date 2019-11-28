<?php

namespace Ht7\Base\Lists;

use \ArrayIterator;
use \IteratorAggregate;
use \Ht7\Base\Utility\Traits\CanLoadByAddItem;
use \Ht7\Base\Utility\Traits\CanRestrictInexVariables;

/**
 * The AbstractItemList can be handled as an indexed array. It is accessable by
 * the foreach loop.
 *
 * @author Thomas Pluess
 */
abstract class AbstractItemList implements IteratorAggregate
{

    use CanRestrictInexVariables,
        CanLoadByAddItem;

    protected $items = [];

    public function __construct(array $data)
    {
        $this->load($data);
    }

    /**
     * Add an item to the end of the list.
     *
     * @param   mixed   $item           The item to add.
     */
    public abstract function addItem($item);

    /**
     * Get the items of this list.
     *
     * @return  array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Get an iterator.
     *
     * This method is the implementation of the IteratorAggergate interface,
     * which makes this class accessable through the foreach loop.
     *
     * @return  ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }

    /**
     * Check if the item which matches the compare value is present in the
     * current item list.
     *
     * @param   mixed   $cv             The compare value.
     */
    public abstract function hasItem($cv);
}

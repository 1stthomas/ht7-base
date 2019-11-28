<?php

namespace Ht7\Base\Lists;

use \ArrayIterator;
use \Countable;
use \IteratorAggregate;
use \Ht7\Base\Utility\Traits\CanRestrictInexVariables;

/**
 * The AbstractItemList can be handled as an indexed array. It is accessable by
 * the foreach loop.
 *
 * @author Thomas Pluess
 */
abstract class AbstractItemList implements Countable, IteratorAggregate
{

    use CanRestrictInexVariables;

    protected $items = [];

    public function __construct(array $data = [])
    {
        $this->load($data);
    }

    /**
     * Add an item to the end of the list.
     *
     * @param   mixed   $item           The item to add.
     * @return  AbstractItemList         The current instance.
     */
    public abstract function add($item);

    /**
     * Count elements of an object
     *
     * @return  integer                 The number of items in the present item list.
     */
    public function count()
    {
        return count($this->items);
    }

    /**
     * Get the item with the present index.
     *
     * @param   mixed       $index
     * @return  mixed
     */
    public function get($index)
    {
        return $this->items[$index];
    }

    /**
     * Get all items of this list.
     *
     * @return  array
     */
    public function getAll()
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
     * Check if there is an item with the present index.
     *
     * @param   mixed   $index          The index to search the element with.
     */
    public function has($index)
    {
        return isset($this->items[$index]);
    }

    /**
     * Check if the item which matches the compare value is present in the
     * current item list.
     *
     * @param   mixed   $compare         The compare value.
     */
    public function hasByValue($compare)
    {
        return in_array($compare, $this->items);
    }

    /**
     * Load the items by the add method.
     *
     * @param   array       $data       The items to load into the present list.
     */
    public function load(array $data)
    {
        foreach ($data as $item) {
            $this->add($item);
        }
    }

}

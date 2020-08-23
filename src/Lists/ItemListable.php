<?php

namespace Ht7\Base\Lists;

use \Countable;
use \IteratorAggregate;

/**
 * Simple List Interface with basic manipulation methods.
 *
 * @author Thomas Pluess
 */
interface ItemListable extends Countable, IteratorAggregate
{

    /**
     * Add an item to the end of the list.
     *
     * @param   mixed   $item           The item to add.
     * @return  AbstractItemList         The current instance.
     */
    public function add($item);

    /**
     * Get the item with the present index.
     *
     * @param   mixed       $index
     * @return  mixed
     */
    public function get($index);

    /**
     * Get all items of this list.
     *
     * @return  array
     */
    public function getAll();

    /**
     * Check if there is an item with the present index.
     *
     * @param   mixed   $index          The index to search the element with.
     */
    public function has($index);

    /**
     * Check if the item which matches the compare value is present in the
     * current item list.
     *
     * @param   mixed   $compare         The compare value.
     */
    public function hasByValue($compare);

    /**
     * Load the items by the add method.
     *
     * @param   array       $data       The items to load into the present list.
     */
    public function load(array $data);

    /**
     * Merge two implementations of the ItemListable interface.
     *
     * @param \Ht7\Base\Lists\ItemListable  $iL     The ItemListable instance to
     *                                              merge with the present one.
     */
    public function merge(ItemListable $iL);

    /**
     * Remove the element with the present index from the list.
     *
     * @param   mixed       $index      The index of the element to remove.
     */
    public function remove($index);
}

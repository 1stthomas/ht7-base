<?php

namespace Ht7\Base\Lists;

/**
 * The ItemList is a simple implementation of the AbstractItemList.
 *
 * It can be handled as an indexed array and is accessable by the foreach loop.
 *
 * @author Thomas Pluess
 */
class ItemList extends AbstractItemList
{

    /**
     * {@inheritdoc}
     */
    public function add($item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function merge(ItemListable $iL)
    {
        $this->items = array_merge($this->getAll(), $iL->getAll());
    }

}

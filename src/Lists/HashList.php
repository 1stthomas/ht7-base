<?php

namespace Ht7\Base\Lists;

use \InvalidArgumentException;
use \Ht7\Base\Lists\Hashable;

/**
 * The AbstractItemList can be handled as an indexed array. It is accessable by
 * the foreach loop.
 *
 * @author Thomas Pluess
 */
class HashList extends AbstractItemList
{

    /**
     *
     * @param   Hashable    $item
     * @throws  InvalidArgumentException
     */
    public function add($item)
    {
        if ($item instanceof Hashable) {
            $this->items[$item->getHash()] = $item;
        } else {
            // @todo: generalize the validation..
            $msg = 'The item has to be an implementation of the Hashable interface, found %s';
            $e = sprintf($msg, gettype($item));

            throw new InvalidArgumentException($e);
        }

        return $this;
    }

    /**
     * Merge an instance of an implementation of the <code>ItemListable</code>
     * interface with the present one.
     *
     * This method will add all inexistent Hashable items into the present
     * <code>HashList</code>.
     */
    public function merge(ItemListable $iL)
    {
        $this->items = array_merge($iL->getAll(), $this->getAll());

//        foreach ($iL->getAll() as $key => $attribute) {
//            if (!$this->has($key)) {
//                $this->add($attribute);
//            }
//        }
    }

}

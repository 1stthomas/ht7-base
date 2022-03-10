<?php

namespace Ht7\Base\Localization\Adapters;

use \Ht7\Base\Lists\HashList;
use \Ht7\Base\Localization\Adapters\Adapterable;

/**
 * Description of AdapterList
 *
 * @author Thomas Pluess
 */
class AdapterList extends HashList
{

    public function add($item)
    {
        if ($item instanceof Adapterable) {
            return parent::add($item);
        } else {
            throw new \InvalidArgumentException(
                    get_class(Adapterable::class)
                    . ' needed, found '
                    . (is_object($item) ? get_class($item) : gettype($item))
            );
        }
    }

    /**
     * Get the adapter with the present index.
     *
     * @param   string      $index      The adapter context.
     * @return  Adapterable
     */
    public function get($index)
    {
        return parent::get($index);
    }

}

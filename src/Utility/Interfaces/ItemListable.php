<?php

namespace Ht7\Base\Utility\Interfaces;

/**
 *
 * @author Thomas Pluess
 */
interface ItemListable
{

    /**
     * Get the identifier key of the current item.
     *
     * @return  mixed                   The identifier which will be used as the
     *                                  key of the current item.
     */
    public function getIdentifier();
}

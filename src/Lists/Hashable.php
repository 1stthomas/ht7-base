<?php

namespace Ht7\Base\Lists;

/**
 *
 * @author Thomas Pluess
 */
interface Hashable
{

    /**
     * Get the identifier key of the current item.
     *
     * @return  mixed                   The identifier which will be used as the
     *                                  key of the current item.
     */
    public function getHash();
}

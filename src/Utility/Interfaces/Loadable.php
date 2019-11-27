<?php

namespace Ht7\Base\Utility\Interfaces;

/**
 *
 * @author Thomas Plüss
 */
interface Loadable
{

    /**
     * Load the current instance with the present data.
     *
     * @param   $data   array       The data to assign to the current instance.
     */
    public function load(array $data);
}

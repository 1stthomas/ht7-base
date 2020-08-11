<?php

namespace Ht7\Base\Utility\Importers\Files;

/**
 *
 * @author Thomas Pluess
 */
interface Importable
{

    /**
     * Get the imported items.
     *
     * @return  array   The array of items coming from <code>$this->transform();</code>.
     */
    public function getItems();

    /**
     * Import the items from the defined location.
     *
     * @return  array       An array of the imported items, fully transformed.
     */
    public function import();
}

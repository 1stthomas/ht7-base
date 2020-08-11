<?php

namespace Ht7\Base\Utility\Importers\Files;

/**
 * Description of Importer
 *
 * @author Thomas Pluess
 */
abstract class AbstractImporter
{

    protected $items;

    public function getItems()
    {
        if (!is_array($this->items)) {
            $this->items = $this->import();
        }

        return $this->items;
    }

    abstract public function import();
}

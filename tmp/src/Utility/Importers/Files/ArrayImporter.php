<?php

namespace Ht7\Base\Utility\Importers\Files;

use \Ht7\Base\Utility\Importers\AbstractImporter;

/**
 * Description of Importer
 *
 * @author Thomas Pluess
 */
class ArrayImporter extends AbstractImporter
{

    protected $name;
    protected $path;

    public function __construct($name, $path)
    {
        $this->setName($name);
        $this->setPath($path);
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function import()
    {
        $items = include_once $this->getPath() . '/' . $this->getName();

        if (is_array($items)) {
            return $items;
        }
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setPath($path)
    {
        $this->path = $path;
    }

}

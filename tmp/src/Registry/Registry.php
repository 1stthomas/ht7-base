<?php

namespace Ht7\Base\Registry;

use \Ht7\Base\Registry\Types\Classes;

/**
 * Description of Registry
 *
 * Soll z.B. eine Klasse/Funktion für Uebersetzungen speichern, die dann verwendet
 * werden kann.
 * Oder Validatoren.
 * Oder Pfade zu Config Dateien.
 *
 * @author Thomas Plüss
 */
class Registry
{

    protected $methods;
    protected $classes;
    protected $instances;

    public function __construct()
    {
        $this->classes = new Classes();
    }

    public function getClasses()
    {
        return $this->classes;
    }

    public function getEntry()
    {
        return [];
    }

    public function register(Entry $entry)
    {

    }

}

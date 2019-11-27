<?php

namespace Ht7\Base\Utility\Traits;

use \ReflectionClass;

/**
 * Handles class constants.
 *
 * This trait provides a method to gain all constants definied by the current
 * class or by one of its anchestor. It is possible to limit the search to the
 * current class, without its anchestors.
 *
 * This trait uses an array to cache the expensive reflection requests.
 *
 * @author      Thomas Plüss
 * @since       0.0.1
 * @version     0.0.1
 * @copyright (c) 2019, Thomas Pluess
 * @license http://URL name
 */
trait Constants
{

    /**
     * Constants cache.
     *
     * @var     array               Assoc array with the full qualified class
     *                              names as keys and there constants as values.
     */
    private static $cacheConstants;

    /**
     * Include ancestor parameter cache.
     *
     * @var     array               Assoc array with the full qualified class
     *                              names as keys and there constants as values.
     */
    private static $cacheIncludeAncestors;

    /**
     * Get the constants defined by this class or its ancestors.
     *
     * @param   boolean     $includeAncestors   True if also constants from anscestors should be included.
     * @return  array                           Assoc array with the constant names as key and
     *                                          the corresponding values as values.
     * @since   0.0.1
     * @link https://stackoverflow.com/questions/956401/can-i-get-consts-defined-on-a-php-class
     * @todo    If someone reassigns a constant in a child class, setting
     *          <code>$icludeAncestors = false</code> could produce unexpected results.
     */
    public static function getConstants($includeAncestors = true)
    {
        $cache = self::getCacheConstants();

        $cacheC = $cache[0] === null ? [] : $cache[0];
        $cacheIA = $cache[1] === null ? [] : $cache[1];

        $calledClass = get_called_class();

        if (!array_key_exists($calledClass, $cacheC) || $cacheIA[$calledClass] !== $includeAncestors) {
            $reflection = new ReflectionClass($calledClass);
            // Get an assoc array of all constants, also the ones defined by ancestors.
            $constants = $reflection->getConstants();

            if (!$includeAncestors) {
                // Look for a parent class.
                $parent = $reflection->getParentClass();

                if (is_object($parent)) {
                    // Get all constants of the parent with its ancestors.
                    $constantsParent = $parent->getConstants();
                    // Remove the constants from the ancestors.
                    $constants = array_diff_assoc($constants, $constantsParent);
                }
            }

            self::setCacheConstants($calledClass, $constants, $includeAncestors);
        } else {
            $constants = $cacheC[$calledClass];
        }

        return $constants;
    }

    /**
     * Get all constants defined by this class or its ancestors with a specific prefix.
     *
     * @param   string      $prefix             The prefix to search for.
     * @param   boolean     $includeAncestors   True if also constants from anscestors should be included.
     * @return  array
     * @since   0.0.1
     */
    public static function getConstantsByPrefix($prefix, $includeAncestors = true)
    {
        $constantsAll = static::getConstants($includeAncestors);

        if (!empty($prefix)) {
            $constants = [];

            foreach ($constantsAll as $name => $value) {
                if (is_array($prefix) && !empty($prefix[0])) {
                    $prefix = $prefix[0];
                }

                if (strpos($name, $prefix) !== false) {
                    $constants[$name] = $value;
                }
            }
        } else {
            $constants = $constantsAll;
        }

        return $constants;
    }

    /**
     * Get the constants cache.
     *
     * @return  array                   Indexed array with <code>self::$cacheConstants</code>
     *                                  on the first position, followed by
     *                                  <code>self::cacheIncludeAncestors</code>.
     */
    private static function getCacheConstants()
    {
        return [
            self::$cacheConstants,
            self::$cacheIncludeAncestors
        ];
    }

    /**
     * Set the constants cache.
     *
     * @param   string  $calledClass    The full qualified class name of the
     *                                  calling class.
     * @param   array   $constants      Assoc array with the constant name as
     *                                  key and the correpsonding value as value.
     * @param   boolean $includeAncestors   Flag to control if the constants from
     *                                  ancestors should be added too (true).
     */
    private static function setCacheConstants($calledClass, $constants, $includeAncestors)
    {
        self::$cacheConstants[$calledClass] = $constants;
        self::$cacheIncludeAncestors[$calledClass] = $includeAncestors;
    }

}

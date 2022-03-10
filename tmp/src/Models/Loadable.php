<?php

namespace Ht7\Base\Models;

/**
 * This interface describes a model, which is loadable with an array of property
 * name/property value pairs.
 *
 * @author      Thomas Pluess
 * @version     0.0.1
 * @since       0.0.1
 */
interface Loadable
{

    /**
     * Add a property to the present model by the property name.
     *
     * This method makes the first letter upper case and adds "set" to the
     * beginning. Then the method is called by the composed method name, submitting
     * the value as parameter.
     *
     * @param   string  $name               The property name.
     * @param   mixed   $value              The new value of the property.
     */
    public function addByPropertyName(string $name, $value);

    /**
     * Load an array of properties into the present model.
     *
     * @param   array   $data           Assoc array of property names as array keys
     *                                  and the related property values as array
     *                                  values.
     */
    public function load(array $data);
}

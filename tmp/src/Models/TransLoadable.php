<?php

namespace Ht7\Base\Models;

use \Ht7\Base\Models\Loadable;

/**
 * This interface describes a model, which is loadable with an array of property
 * name/property value pairs.
 *
 * Additionally this model lets you define transformations, where e.g. short forms
 * of property names can be transformed into the original ones.
 *
 * @author      Thomas Pluess
 * @version     0.0.1
 * @since       0.0.1
 */
interface TransLoadable extends Loadable
{

    /**
     * Get the transformations.
     *
     * @return  array                       Assoc array with the name to transform
     *                                      as key and the name to use as values.
     */
    public function getTransformations();

    /**
     * Set the transformations.
     *
     * @param   array   $transformations    Assoc array with the name to transform
     *                                      as key and the name to use as values.
     * @return  void
     */
    public function setTransformations(array $transformations);
}

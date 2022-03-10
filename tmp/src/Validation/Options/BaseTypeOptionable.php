<?php

namespace Ht7\Base\Validation\Options;

use \Ht7\Base\Validation\Options\BaseOptionable;

/**
 * This interface describes the required methods for a validation type option class.
 *
 * @author      Thomas Pluess
 * @version     0.0.1
 * @since       0.0.1
 */
interface BaseTypeOptionable
{

    /**
     * Get the base options class, which provides general settings.
     *
     * @return  BaseOptionable              The base options
     */
    public function getBaseOptions();

    /**
     * Set the base options class, which provides general settings.
     *
     * @param   BaseOptionable  $options    The base options
     * @return  void
     */
    public function setBaseOptions(BaseOptionable $options);
}

<?php

namespace Ht7\Base\Validation;

use \Ht7\Base\Lists\Hashable;
use \Ht7\Base\Validation\Lists\AbstractValidationList;

/**
 * Abstract implementation of a base validation container. This base is used by
 * the validators and the validation types.
 *
 * @author      Thomas Pluess
 * @version     0.0.1
 * @since       0.0.1
 */
interface ValidationContainerable extends Hashable
{

    /**
     * Create a validation list by an array and return it.
     *
     * @param   array       $elements       Assoc array of type name/class
     *                                      definition pairs.
     * @return  AbstractValidationList      The validation list created
     *                                      with the present type definitions.
     */
    public function createListFromArray(array $elements);

    /**
     * Create an option model by an array and return it.
     *
     * @param   array       $options        Assoc array of type property name/
     *                                      property value pairs.
     * @return  mixed                       The options model instance created
     *                                      with the present definitions.
     */
    public function createOptionsFromArray(array $options);

    /**
     * Get an array of default list elements.
     *
     * @return  array                       The default list items, which can be
     *                                      expanded/replaced by the related
     *                                      contructor paramters.
     */
    public function getDefaults();

    /**
     * Get the validation list.
     *
     * @return  AbstractValidationList      The validation list.
     */
    public function getList();

    /**
     * Get the options of the present container.
     *
     * @return  mixed                       The option model.
     */
    public function getOptions();

    /**
     * Set the validation list.
     *
     * @param   AbstractValidationList  $list   The validation list.
     * @return  void
     */
    public function setList(AbstractValidationList $list);

    /**
     * Set the options of the present container.
     *
     * @param   mixed   $options            The option model.
     * @return  void
     */
    public function setOptions($options);
}

<?php

namespace Ht7\Base\Validation\Validators;

use \InvalidArgumentException;
use \Ht7\Base\Validation\AbstractValidationContainer;
use \Ht7\Base\Validation\Lists\TypeList;
use \Ht7\Base\Validation\Types\DefaultTypes;

/**
 * This is an abstract implementation of a base validator. This class does not
 * define any validation method.
 *
 * @author      Thomas Pluess
 * @version     0.0.1
 * @since       0.0.1
 */
abstract class AbstractValidator extends AbstractValidationContainer
{

    /**
     * Create a validation type list by an array and return it.
     *
     * @param   array       $types          Assoc array of type names/type class
     *                                      definition pairs.
     * @return  TypeList                    The validation type list created
     *                                      with the present type definitions.
     */
    public function createListFromArray(array $types)
    {
        return new TypeList($types, []);
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaults()
    {
        return (new DefaultTypes())->get();
    }

    /**
     * Get the validation type list.
     *
     * @return  TypeList                        The validation type list.
     */
    public function getList()
    {
        return parent::getList();
    }

    /**
     * Set the validation type list.
     *
     * @param   TypeList    $list               The validation type list.
     * @return  void
     */
    public function setList($list)
    {
        if ($list instanceof TypeList) {
            parent::setList($list);
        } else {
            $e = 'The list parameter has to be an instance of ' . TypeList::class . '.';

            throw new InvalidArgumentException($e);
        }
    }

}

<?php

namespace Ht7\Base\Validation\Validators;

use \Ht7\Base\Validation\Lists\TypeList;

/**
 * This is an abstract implementation of a base validator. This class does not
 * define any validation method.
 *
 * @author      Thomas Pluess
 * @version     0.0.1
 * @since       0.0.1
 */
abstract class AbstractValidatorOld
{

    protected $options;

    /**
     * @var     TypeList                    The validation type list.
     */
    protected $typeList;

    /**
     * Create an instance of the <code>AbstractValidator</code> class.
     *
     * @param   array   $types              Assoc array of type names/type class
     *                                      definition pairs.
     */
    public function __construct(array $types, $isMerged = true)
    {
        $typesMerged = $isMerged ? array_merge($this->getDefaults(), $types) : $types;

        $this->setTypeList($this->createTypeListFromArray($typesMerged));
    }

    abstract public function getDefaults();

    /**
     * Create a validation type list by an array and return it.
     *
     * @param   array       $types          Assoc array of type names/type class
     *                                      definition pairs.
     * @return  TypeList                    The validation type list created
     *                                      with the present type definitions.
     */
    public function createTypeListFromArray(array $types)
    {
        return new TypeList($types, []);
    }

    /**
     * Get the validation type list.
     *
     * @return  TypeList                        The validation type list.
     */
    public function getTypeList()
    {
        return $this->typeList;
    }

    /**
     * Set the validation type list.
     *
     * @param   TypeList    $typeList           The validation type list.
     * @return  void
     */
    public function setTypeList(TypeList $typeList)
    {
        $this->typeList = $typeList;
    }

}

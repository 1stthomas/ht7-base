<?php

namespace Ht7\Base\Messages\Options\Parts;

use \Ht7\Base\Models\AbstractLoadableModel;

/**
 * Description of Exception
 *
 * @author Thomas Pluess
 */
class InvalidDataTypeException extends AbstractLoadableModel
{

    protected $allowedClasses;
    protected $allowedPrimitives;
    protected $classPartsPattern;
    protected $nameInvalidProperty;
    protected $valueInvalidProperty;

    public function getAllowedClasses()
    {
        return $this->allowedClasses;
    }

    public function getAllowedPrimitives()
    {
        return $this->allowedPrimitives;
    }

    public function getClassPartsPattern()
    {
        return $this->classPartsPattern;
    }

    public function getNameInvalidProperty()
    {
        return $this->nameInvalidProperty;
    }

    public function getValueInvalidProperty()
    {
        return $this->valueInvalidProperty;
    }

    public function setAllowedClasses($allowedClasses)
    {
        $this->allowedClasses = $allowedClasses;
    }

    public function setAllowedPrimitives($allowedPrimitives)
    {
        $this->allowedPrimitives = $allowedPrimitives;
    }

    public function setClassPartsPattern($classPartsPattern)
    {
        $this->classPartsPattern = $classPartsPattern;
    }

    public function setNameInvalidProperty($nameInvalidProperty)
    {
        $this->nameInvalidProperty = $nameInvalidProperty;
    }

    public function setValueInvalidProperty($valueInvalidProperty)
    {
        $this->valueInvalidProperty = $valueInvalidProperty;
    }

}

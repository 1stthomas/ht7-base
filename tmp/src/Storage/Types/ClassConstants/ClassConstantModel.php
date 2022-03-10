<?php

namespace Ht7\Base\Storage\Types\ClassConstants;

use \Ht7\Base\Storage\StorageTypes;
use \Ht7\Base\Storage\Models\AbstractStorageModel;

/**
 * Description of ClassConstantModel
 *
 * @author Thomas Pluess
 */
class ClassConstantModel extends AbstractStorageModel
{

    protected $class;

//    protected $constant;

    public function __construct(string $class)
//    public function __construct(string $class, string $constant)
    {
        $this->storageType = StorageTypes::CLASS_CONSTANT;

        $this->setClass($class);
//        $this->setConstant($constant);
    }

    public function getClass()
    {
        return $this->class;
    }

//    public function getConstant()
//    {
//        return $this->constant;
//    }

    public function setClass(string $class)
    {
        $this->class = $class;
    }

//    public function setConstant(string $contstant)
//    {
//        $this->constant = $contstant;
//    }
}

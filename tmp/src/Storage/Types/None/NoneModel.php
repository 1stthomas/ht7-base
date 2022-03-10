<?php

namespace Ht7\Base\Storage\Types\None;

use \Ht7\Base\Storage\StorageTypes;
use \Ht7\Base\Storage\Models\AbstractStorageModel;

/**
 * Description of ClassConstantModel
 *
 * @author Thomas Pluess
 */
class NoneModel extends AbstractStorageModel
{

    public function __construct()
    {
        $this->storageType = StorageTypes::NONE;
    }

}

<?php

namespace Ht7\Base\Localization\Adapters;

use \Ht7\Base\Localization\Adapters\Adapterable;
use \Ht7\Base\Storage\Models\StorageModelable;

/**
 * Description of AbstractAdapter
 *
 * @author Thomas Pluess
 */
abstract class AbstractAdapter implements Adapterable
{

    protected $context;
    protected $storageType;

    public function __construct($context)
    {
        $this->context = $context;
    }

    /**
     * {@inheritdoc}
     */
    public function getHash()
    {
        return $this->context;
    }

    /**
     * {@inheritdoc}
     */
    public function getStorageType()
    {
        return $this->storageType;
    }

    /**
     * {@inheritdoc}
     */
    public function setStorageType(StorageModelable $storageType)
    {
        $this->storageType = $storageType;
    }

}

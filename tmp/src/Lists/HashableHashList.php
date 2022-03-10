<?php

namespace Ht7\Base\Lists;

use \Ht7\Base\Lists\Hashable;
use \Ht7\Base\Lists\HashList;

/**
 * This list can be used as items of other <code>HashLists</code>.
 *
 * @author Thomas Pluess
 */
class HashableHashList extends HashList implements Hashable
{

    protected $hash;

    public function __construct(string $hash, array $data = array())
    {
        $this->setHash($hash);

        parent::__construct($data);
    }

    /**
     * {@inheritdoc}
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Set the hash of the present HashList.
     *
     * @param   string  $hash
     */
    public function setHash(string $hash)
    {
        $this->hash = $hash;
    }

}

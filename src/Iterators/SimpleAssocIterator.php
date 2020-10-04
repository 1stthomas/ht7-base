<?php

namespace Ht7\Base\Iterators;

use \Ht7\Base\Iterators\SimpleIndexIterator;

/**
 * A simple iterator to provide the methods defined by the native <code>Iterator</code>
 * interface.
 *
 * @author      Thomas Pluess
 * @version     0.0.1
 * @since       0.0.1
 */
class SimpleAssocIterator extends SimpleIndexIterator
{

    /**
     * @var     array               The array keys.
     */
    protected $keys;

    public function __construct(array $array)
    {
        parent::__construct($array);

        $this->keys = array_keys($array);
    }

    /**
     * {@inheritdoc}
     */
    public function key()
    {
        return $this->keys[$this->position];
    }

    /**
     * {@inheritdoc}
     */
    public function valid()
    {
        return isset($this->keys[$this->position]);
    }

}

<?php

namespace Ht7\Base\Iterators;

use \Iterator;

/**
 * A simple iterator to provide the methods defined by the native <code>Iterator</code>
 * interface.
 *
 * @author      Thomas Pluess
 * @version     0.0.1
 * @since       0.0.1
 */
class SimpleIndexIterator implements Iterator
{

    /**
     * @var     array               The array to iterate.
     */
    protected $array;

    /**
     *
     * @var     integer             The current position.
     */
    protected $position;

    public function __construct(array $array)
    {
        $this->array = $array;

        $this->rewind();
    }

    /**
     * {@inheritdoc}
     */
    public function current()
    {
        return $this->array[$this->key()];
    }

    /**
     * {@inheritdoc}
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        $this->position++;
    }

    /**
     * {@inheritdoc}
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * {@inheritdoc}
     */
    public function valid()
    {
        return isset($this->array[$this->key()]);
    }

}

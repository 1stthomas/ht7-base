<?php

namespace Ht7\Base\Iterators;

use \Iterator;

/**
 * Description of SimpleIterator
 *
 * @author Thomas Pluess
 */
class SimpleIterator implements Iterator
{

    protected $array;
    protected $position;

    public function __construct(array $array)
    {
        $this->array = $array;

        $this->rewind();
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
    public function valid()
    {
        return isset($this->array[$this->key()]);
    }

}

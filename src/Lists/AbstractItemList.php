<?php

namespace Ht7\Base\Lists;

use \InvalidArgumentException;
use \Ht7\Base\Iterators\SimpleIterator;
use \Ht7\Base\Utility\Traits\CanRestrictInexVariables;

/**
 * The AbstractItemList can be handled as an indexed array. It is accessable by
 * the foreach loop.
 *
 * @author Thomas Pluess
 * @since       0.0.1
 * @version     0.0.1
 * @copyright (c) 2020, Thomas Pluess
 */
abstract class AbstractItemList implements ItemListable
{

    use CanRestrictInexVariables;

    protected $items = [];

    public function __construct(array $data = [])
    {
        $this->load($data);
    }

    /**
     * {@inheritdoc}
     */
    public abstract function add($item);

    /**
     * {@inheritdoc}
     */
    public abstract function merge(ItemListable $iL);

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->getAll());
    }

    /**
     * {@inheritdoc}
     */
    public function get($index)
    {
        return $this->items[$index];
    }

    /**
     * {@inheritdoc}
     */
    public function getAll()
    {
        return $this->items;
    }

    /**
     * Get an iterator.
     *
     * This method is the implementation of the IteratorAggergate interface,
     * which makes this class accessable through the foreach loop.
     *
     * @return  SimpleIterator
     */
    public function getIterator()
    {
        return new SimpleIterator($this->getAll());
    }

    /**
     * {@inheritdoc}
     */
    public function getNext($index)
    {
        return empty($index) ? null : $this->items[($index + 1)];
    }

    /**
     * {@inheritdoc}
     */
    public function getPrevious($index)
    {
        return empty($index) ? null : $this->items[($index - 1)];
    }

    /**
     * {@inheritdoc}
     */
    public function has($index)
    {
        return isset($this->items[$index]);
    }

    /**
     * {@inheritdoc}
     */
    public function hasByValue($compare)
    {
        return in_array($compare, $this->items);
    }

    /**
     * {@inheritdoc}
     */
    public function load(array $data)
    {
        foreach ($data as $item) {
            $this->add($item);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function remove($index)
    {
        unset($this->items[$index]);
    }

    /**
     * Throw an <code>InvalidArgumentException</code>.
     *
     * @param   mixed   $index              The invalid index.
     * @throws InvalidArgumentException
     */
    protected function handleInvalidIndex($index)
    {
        $e = 'Invalid index: ' . $index;

        throw new InvalidArgumentException($e);
    }

}

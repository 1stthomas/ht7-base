<?php

namespace Ht7\Base\Validation\Lists;

use \Ht7\Base\Validation\Lists\AbstractValidationList;
use \Ht7\Base\Validation\Iterators\RuleListIterator;
use \Ht7\Base\Validation\Rules\Rulable;

/**
 * This is a container for rule names to rule class definition pointers.
 *
 * @author Thomas Pluess
 */
class RuleList extends AbstractValidationList
{

    /**
     * Get a rule instance with the present rule handle.
     *
     * @param   string      $index      The rule handle.
     * @return  Rulable
     */
    public function get($index)
    {
        $item = parent::get($index);

        return new $item;
    }

    /**
     * {@inheritdoc}
     *
     * @return  RuleListIterator        Rule list specific
     */
    public function getIterator()
    {
        return new RuleListIterator($this->getAll());
    }

}

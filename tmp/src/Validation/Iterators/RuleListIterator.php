<?php

namespace Ht7\Base\Validation\Iterators;

use \Ht7\Base\Iterators\SimpleAssocIterator;

/**
 * Description of RuleListIterator
 *
 * @author Thomas Pluess
 */
class RuleListIterator extends SimpleAssocIterator
{

    public function current()
    {
        $current = parent::current();

        return new $current();
    }

}

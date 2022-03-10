<?php

namespace Ht7\Base\Validation\Types;

use \Ht7\Base\Validation\Types\Accepted;
use \Ht7\Base\Validation\Types\InstOf;

/**
 * Description of DefaultTypes
 *
 * @author Thomas Pluess
 */
class DefaultTypes
{

    /**
     * Get the default type definitions.
     *
     * @return  array           Assoc array of type handle/type class pairs.
     */
    public function get()
    {
        return [
            'accepted' => Accepted::class,
            'instanceOf' => InstOf::class,
        ];
    }

}

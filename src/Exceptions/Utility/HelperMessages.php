<?php

namespace Ht7\Base\Exceptions\Utility;

use \Ht7\Base\Enum;

/**
 * This is a enumeration with helper texts for the exception messages.
 *
 * @author Thomas Plüss
 */
class HelperMessages extends Enum
{

    /**
     * Use this one if there is only one instance.
     */
    const INSTANCES_ONE = 'an instance of %s';

    /**
     * Use this one if there are two instances.
     */
    const INSTANCES_TWO = 'an instance of %s or %s';

    /**
     * Use this one if there are more than two instances.
     */
    const INSTANCES_MT_TWO = 'an instance of: %s';

    /**
     * Use this one for a list of primitiv datatypes.
     */
    const PRIMITIV_MT_ZERO = 'a type of: %s';

    /**
     * Use this to combine "string a" with "string b".
     */
    const INSTANCES_PRIMITIV = '%s or %s';

}

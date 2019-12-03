<?php

namespace Ht7\Base\Exceptions\Utility;

use \Ht7\Base\Enum;

/**
 * Description of ExceptionMessages
 *
 * @author 1stthomas
 */
class HelperMessages extends Enum
{

    const INSTANCES_ONE = 'an instance of %s';
    const INSTANCES_TWO = 'an instance of %s or %s';
    const INSTANCES_MT_TWO = 'an instance of: %s';
    const PRIMITIV_MT_ZERO = 'a type of: %s';
    const INSTANCES_PRIMITIV = '%s or %s';

}

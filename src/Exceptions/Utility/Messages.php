<?php

namespace Ht7\Base\Exceptions\Utility;

use \Ht7\Base\Enum;

/**
 * Description of ExceptionMessages
 *
 * @author 1stthomas
 */
class Messages extends Enum
{

    const INVALID_DATATYPE = '%s must be %s, found %s.';
    const WRONG_DATATYPE = '%s must be %s, found %s.';

}

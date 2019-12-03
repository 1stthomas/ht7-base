<?php

namespace Ht7\Base\Exceptions\Utility;

use \Ht7\Base\Enum;

/**
 * This is a enumeration with the texts for the exception messages.
 *
 * @author Thomas Plüss
 */
class Messages extends Enum
{

    const INVALID_DATATYPE = '%s must be %s, found %s.';
    // @todo: remove the following..
    const WRONG_DATATYPE = '%s must be %s, found %s.';

}

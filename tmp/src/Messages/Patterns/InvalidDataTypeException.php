<?php

namespace Ht7\Base\Messages\Patterns;

use \Ht7\Base\Enum;

/**
 * Enum with exception message patterns.
 *
 * @author Thomas Plüss
 */
class InvalidDataTypeException extends Enum
{

    /**
     * This pattern can be used if there is only one class.
     */
    const CLASSES_ONE = '%s must be an instance of %s, found %s.';

    /**
     * This pattern can be used if there are two classes.
     */
    const CLASSES_TWO = '%s must be an instance of %s or %s, found %s.';

    /**
     * This pattern can be used if there are more than two classes.
     */
    const CLASSES_MT_TWO = '%s must be an instance of %s, found %s.';

    /**
     * This pattern can be used if there are more than zero datatypes.
     */
    const PRIMITIV_MT_ZERO = '%s must be a type of %s, found %s.';

    /**
     * This pattern can be used if there is only one class and more than zero datatypes.
     */
    const CLASSES_ONE_PRIMITIV_MT_ZERO = '%s must be an instance of %s or a type of %s, found %s.';

    /**
     * This pattern can be used if there are two classes and more than zero datatypes.
     */
    const CLASSES_TWO_PRIMITIV_MT_ZERO = '%s must be an instance of %s or %s or a type of %s, found %s.';

    /**
     * This pattern can be used if there are more than two classes and more than zero datatypes.
     */
    const CLASSES_MT_TWO_PRIMITIV_MT_ZERO = '%s must be an instance of %s or a type of %s, found %s.';

}

<?php

namespace Ht7\Base\Localization;

use \Ht7\Base\Validation\ExceptionTrigger;

/**
 * Description of Translator
 *
 * @author 1stthomas
 */
class Translator
{

    const TRANSLATION_TYPE_SIMPLE = 1;
    const TRANSLATION_TYPE_CONTEXT = 2;
    const TRANSLATION_TYPE_PLURAL = 3;

    protected static $translator;

    public static function t($type, $str, array $parameters)
    {
        if (static::$translator === null) {
            // Until we can set this proper into the registry and get the current
            // translator interface, we do it this dirty way.
            switch ($type) {
                case static::TRANSLATION_TYPE_SIMPLE:
                case static::TRANSLATION_TYPE_CONTEXT:
                case static::TRANSLATION_TYPE_PLURAL:
                    array_unshift($parameters, $str);

                    print_r($parameters);

                    return call_user_func_array('sprintf', $parameters);
                default:
                    ExceptionTrigger::class;
                    break;
            }
        } else {
            // @todo...
        }
    }

}

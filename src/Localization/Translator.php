<?php

namespace Ht7\Base\Localization;

use \InvalidArgumentException;

/**
 * This class tries to find a registered translator. If there can not be found
 * one, the function <code>sprintf()</code> will be used to combine the several
 * text parts.
 *
 * @author Thomas Plüss
 */
class Translator
{

    /**
     * This is for a simple translation, without context or further plural forms.
     */
    const TRANSLATION_TYPE_SIMPLE = 1;

    /**
     * This is a translation by context, to be able to use same texts for several
     * different translations.
     */
    const TRANSLATION_TYPE_CONTEXT = 2;

    /**
     * This kind needs in minimum 2 text patterns, one for the singular and the
     * second for the plural.
     */
    const TRANSLATION_TYPE_PLURAL = 3;

    protected static $translator;

    /**
     * Get the current translator.
     *
     * In case this property was not set, an instance of this class will be returned.
     *
     * @return type
     */
    public static function getTranslator()
    {
        if (empty(static::$translator)) {
            static::$translator = new static();
        }

        return static::$translator;
    }

    /**
     * Set the current translator.
     *
     * @param type $translator
     */
    public static function setTranslator($translator)
    {
        static::$translator = $translator;
    }

    /**
     * Translate a given text pattern with placeholders into a full text.
     *
     * @param   integer     $type       The translation type. Use one of the
     *                                  defined constants from this class.
     * @param   mixed       $str        For simple and context translation types
     *                                  there is only one text pattern needed.
     *                                  To make a plural translation working, in
     *                                  minimum 2 text patterns are needed.
     * @param   array $parameters
     * @param   type $context           The context of the translation. This is
     *                                  only needed for translation types
     *                                  <code>Translator::TRANSLATION_TYPE_CONTEXT</code>.
     * @return  string                  The translation.
     */
    public static function t($type, $str, array $parameters, $context = '')
    {
        $return = null;

        if (static::$translator === null) {
            // Until we can set this proper into the registry and get the current
            // translator interface, we do it this dirty way.
            switch ($type) {
                case static::TRANSLATION_TYPE_SIMPLE:
                case static::TRANSLATION_TYPE_CONTEXT:
                case static::TRANSLATION_TYPE_PLURAL:
                    array_unshift($parameters, $str);

                    $return = call_user_func_array('sprintf', $parameters);
                    break;
                default:
                    $msg = 'Undefined translation type %s';
                    $e = static::t(static::TRANSLATION_TYPE_CONTEXT, $msg, [$type], 'ht7-base-testing');

                    throw new InvalidArgumentException($e);
            }
//        } else {
            // @todo...
        }

        return $return;
    }

}

<?php

namespace Ht7\Base\Localization;

/**
 * This class tries to find a registered translation adapter. If there can not
 * be found one, the function <code>sprintf()</code> will be used to combine the
 * several text parts.
 *
 * @author Thomas Plüss
 */
class TranslatorOld
{

    /**
     * The object which defines the mapping for the translation methods.
     *
     * @var Translatorable
     */
    protected static $adapter;

    /**
     * Get the current translation adapter.
     *
     * In case this property was not set, an instance of this class will be returned.
     *
     * @return Translatorable
     */
    public static function getAdapter()
    {
        if (empty(static::$adapter)) {
            // @todo: go through the registry!!
            static::$adapter = new Adapter();
        }

        return static::$adapter;
    }

    /**
     * Set the current translation adapter.
     *
     * @param Translatorable $adapter
     */
    public static function setAdapter($adapter)
    {
        static::$adapter = $adapter;
    }

    /**
     * Translate a given text pattern with placeholders into a full text.
     * This method supports only singular forms.
     *
     * @param   string  $str            For simple and context translation types
     *                                  there is only one text pattern needed.
     * @param   array   $parameters
     * @param   string  $context        The context of the translation. This is
     *                                  only needed for contextual translations.
     * @return  string                  The translated string.
     */
    public static function t($str, array $parameters = [], $context = '')
    {
        $adapter = static::getAdapter();

        if (empty($context)) {
            $return = $adapter->t1($str, $parameters);
        } else {
            $return = $adapter->t3($context, $str, $parameters);
        }

        return $return;
    }

    /**
     *
     * @param   string      $str1       Singular string to translate.
     * @param   string      $str2       Plural string to translate.
     * @param   array       $parameters
     * @param   string      $context    The context of the translation. This is
     *                                  only needed for contextual translations.
     * @return  string                  The translated string.
     */
    public static function t2($str1, $str2, $count, array $parameters = [], $context = '')
    {
        $adapter = static::getAdapter();

        if (empty($context)) {
            $return = $adapter->t2($str1, $str2, $count, $parameters);
        } else {
            $return = $adapter->t4($context, $str1, $str2, $count, $parameters);
        }

        return $return;
    }

}

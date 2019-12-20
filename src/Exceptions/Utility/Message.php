<?php

namespace Ht7\Base\Exceptions\Utility;

use \InvalidArgumentException;
use \Ht7\Base\Utility\Strings;
use \Ht7\Base\Localization\Translator;

/**
 * This class composes several messages.
 *
 * The main method to use is <code>Message::compose()</code>.
 *
 * @author Thomas Plüss
 */
class Message
{

    /**
     *
     * @param   string  $name           The name of the invalid property. This
     *                                  should be the reason for the current
     *                                  exception.
     * @param   string  $class          The exception class.
     * @param   mixed   $found          The invalid variable. E.g. for the
     *                                  InvalidDatatypeException this parameter
     *                                  will be transformed with <code>get_type()</code>.
     * @param   array   $primitiv       An array of allowed primitiv datatypes.
     * @param   array   $instances      An array of classes whichs instances are
     *                                  allowed.
     * @return  string                  The exception message.
     */
    public static function compose(string $name, string $class, $found, array $primitiv = [], array $instances = [])
    {
        // Get the index to gain the desired text pattern.
        $index = static::getIndex($class);
        $parameters = [static::getParameters($primitiv, $instances)];
        // Prepend the name of the invalid property.
        array_unshift($parameters, $name);

        // Get the invalid datatype. For objects its class will be reported.
        $foundType = gettype($found) === 'object' ? get_class($found) : gettype($found);
        // Append the invalid datatype/class.
        array_push($parameters, $foundType);

        return Translator::t(
                        Translator::TRANSLATION_TYPE_SIMPLE,
                        Messages::getConstant($index),
                        $parameters
        );
    }

    /**
     * Get the index of the string for the calling exception class.
     *
     * This method removes all namespaces and the word "Exception" and
     * decamelizes the result. E.g. <code>InvalidDatatypeException</code> will
     * result in <code>invalid_datatype</code>.
     *
     * @param   string  $class      The absolute class name of the exception to
     *                              throw.
     */
    public static function getIndex($class)
    {
        $parts = explode('\\', $class);
        $count = count($parts);

        if ($class !== '' && $count > 0) {
            $name = str_replace('Exception', '', $parts[$count - 1]);

            return Strings::decamelize($name);
        } else {
            $e = Translator::t(
                            Translator::TRANSLATION_TYPE_CONTEXT,
                            '%s must not be empty.',
                            ['Classname'],
                            'ht7-base-testing'
            );

            throw new InvalidArgumentException($e);
        }
    }

    /**
     * Get the translation for a list of instances.
     *
     * @param   array   $instances      An indexed array with class names.
     * @return  string                  The composed instance string.
     */
    public static function getInstances(array $instances)
    {
        $text = '';

        switch (count($instances)) {
            case 0:
                return $text;
            case 1:
                $text = HelperMessages::INSTANCES_ONE;
                break;
            case 2:
                $text = HelperMessages::INSTANCES_TWO;
                break;
            case 3:
            default:
                $text = HelperMessages::INSTANCES_MT_TWO;
                $instances = [implode(', ', $instances)];
                break;
        }

        return Translator::t(
                        Translator::TRANSLATION_TYPE_SIMPLE,
                        $text,
                        $instances
        );
    }

    /**
     * Get the translation text of a composition of primitiv datatypes and
     * instances.
     *
     * @param   string  $primitiv       The transformed string of primitiv datatypes.
     * @param   string  $instances      The transformed string of instances.
     * @return  string                  The composed message.
     */
    public static function getParameters($primitiv, $instances)
    {
        if (empty($primitiv) && empty($instances)) {
            // @todo: throw error.
            return 'undefined';
        } elseif (!empty($primitiv) && empty($instances)) {
            return static::getPrimitivs($primitiv);
        } elseif (empty($primitiv) && !empty($instances)) {
            return static::getInstances($instances);
        } else {
            $arr = [
                static::getPrimitivs($primitiv),
                static::getInstances($instances)
            ];

            return Translator::t(
                            Translator::TRANSLATION_TYPE_SIMPLE,
                            HelperMessages::INSTANCES_PRIMITIV,
                            $arr
            );
        }
    }

    /**
     * Get the translation for a list of primitiv datatypes.
     *
     * @param   array   $list           Indexed array of primitiv datatypes.
     * @return  string                  The composed datatype string.
     */
    public static function getPrimitivs(array $list)
    {
        return Translator::t(
                        Translator::TRANSLATION_TYPE_SIMPLE,
                        HelperMessages::PRIMITIV_MT_ZERO,
                        [implode(', ', $list)]
        );
    }

}

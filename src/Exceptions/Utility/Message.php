<?php

namespace Ht7\Base\Exceptions\Utility;

use \Ht7\Base\Helpers\Strings;
use \Ht7\Base\Localization\Translator;

/**
 * Description of ExceptionMessages
 *
 * @author 1stthomas
 */
class Message
{

    public static function compose(string $name, string $class, $found, array $primitiv, array $instances)
    {
        $index = static::getIndex($class);
        $parameters = [static::getParameters($primitiv, $instances)];
        array_unshift($parameters, $name);

        $foundType = gettype($found) === 'object' ? get_class($found) : gettype($found);
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
     * @param   string  $class
     */
    public static function getIndex($class)
    {
        $parts = explode('\\', $class);
        $count = count($parts);

        if ($count > 0) {
            $name = str_replace('Exception', '', $parts[$count - 1]);

            return Strings::decamelize($name);
        }
    }

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
                break;
        }

        return Translator::t(
                        Translator::TRANSLATION_TYPE_SIMPLE,
                        $text,
                        $instances
        );
    }

    public static function getList(array $list)
    {
//        return implode(', ', $list);
        return Translator::t(
                        Translator::TRANSLATION_TYPE_SIMPLE,
                        HelperMessages::PRIMITIV_MT_ZERO,
                        [implode(', ', $list)]
        );
    }

    public static function getParameters($primitiv, $instances)
    {
        if (empty($primitiv) && empty($instances)) {
            // @todo: throw error.
            return 'undefined';
        } elseif (!empty($primitiv) && empty($instances)) {
            return static::getList($primitiv);
        } elseif (empty($primitiv) && !empty($instances)) {
            return static::getInstances($instances);
        } else {
            $arr = [
                static::getList($primitiv),
                static::getInstances($instances)
            ];

            print_r($primitiv);
            print_r($instances);
            print_r($arr);

            return Translator::t(
                            Translator::TRANSLATION_TYPE_SIMPLE,
                            HelperMessages::INSTANCES_PRIMITIV,
                            $arr
            );
        }
    }

}

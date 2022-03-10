<?php

namespace Ht7\Base\Messages\Types\Parts;

use \Ht7\Base\Messages\Options\BaseOptions;

/**
 * Description of Exception
 *
 * @author Thomas Pluess
 */
class InvalidDataTypeException
{

    public function getParts($parts)
    {

    }

    /**
     * Get the translation for a list of instances.
     *
     * @param   BaseOptions $options    An indexed array with class names.
     * @return  string                  The composed instance string.
     */
    public function getInstances(BaseOptions $options)
    {
        $text = '';

        $classes = $options->getParts()->getAllowedClasses();
        $partsPatternClass = $options->getParts()->getClassPartsPattern();

        switch (count($classes)) {
            case 0:
                return $text;
            case 1:
                $text = constant($partsPatternClass . '::CLASSES_ONE');
                break;
            case 2:
                $text = constant($partsPatternClass . '::CLASSES_TWO');
                break;
            case 3:
            default:
                $text = constant($partsPatternClass . '::CLASSES_MT_TWO');
                $instances = [implode(', ', $instances)];
                break;
        }

        return Translator::t($text, $instances);
    }

    /**
     * Get the translation text of a composition of primitiv datatypes and
     * instances.
     *
     * @param   string  $primitiv       The transformed string of primitiv datatypes.
     * @param   string  $instances      The transformed string of instances.
     * @return  string                  The composed message.
     */
    public function getParameters($primitiv, $instances)
    {
        if (empty($primitiv) && empty($instances)) {
            // @todo: throw error.
            return 'undefined';
        } elseif (!empty($primitiv) && empty($instances)) {
            return $this->getPrimitivs($primitiv);
        } elseif (empty($primitiv) && !empty($instances)) {
            return $this->getInstances($instances);
        } else {
            $arr = [
                $this->getPrimitivs($primitiv),
                $this->getInstances($instances)
            ];

            return Translator::t(HelperMessages::INSTANCES_PRIMITIV, $arr);
        }
    }

    /**
     * Get the translation for a list of primitiv datatypes.
     *
     * @param   array   $list           Indexed array of primitiv datatypes.
     * @return  string                  The composed datatype string.
     */
    public function getPrimitivs(array $list)
    {
        return Translator::t(
                        HelperMessages::PRIMITIV_MT_ZERO,
                        [implode(', ', $list)]
        );
    }

}

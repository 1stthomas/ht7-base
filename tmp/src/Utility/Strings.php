<?php

namespace Ht7\Base\Utility;

/**
 * Description of String
 *
 * @author 1stthomas
 */
class Strings
{

    /**
     * @param   string  $string
     * @return  string
     * @see https://stackoverflow.com/questions/1993721/how-to-convert-pascalcase-to-pascal-case/35719689#35719689
     *
     * @todo: write test, see link..
     */
    public static function decamelize($string)
    {
        return strtolower(
                preg_replace(
                        ['/([a-z\d])([A-Z])/', '/([^_])([A-Z][a-z])/'],
                        '$1_$2',
                        $string
                )
        );
    }

}

<?php

namespace Ht7\Base;

/**
 * Provide options to be used by \Ht7\Base\ObjectRestricted
 *
 * @author 1stthomas
 */
class OrOptionsFactory
{

    /**
     * Return an options instance with default mode.
     *
     * @return  OrOptionsAbstract
     */
    public static function getOrOptionDefault()
    {
        $data = ['lockProperties' => false];

        return new class (['lockProperties' => false]) extends OrOptionsAbstract
        {

        };
        }

        /**
         * Return an options instance with restricted mode.
         *
         * @return  OrOptionsAbstract
         */
        public static function getOrOptionRestricted()
        {
        return new class() extends OrOptionsAbstract
        {

        };
        }

        }


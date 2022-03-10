<?php

namespace Ht7\Base\Registry;

/**
 *
 * @author Thomas Plüss
 */
interface Entry
{

    /**
     * @return  type                    The entry category.
     */
    public function getCategory();

    /**
     * @return  string                  The entry name.
     */
    public function getName();

    /**
     * @return  string                  The entry type.
     */
    public function getType();
}

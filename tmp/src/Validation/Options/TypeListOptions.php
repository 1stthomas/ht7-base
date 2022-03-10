<?php

namespace Ht7\Base\Validation\Options;

use \Ht7\Base\Models\AbstractLoadableModel;

/**
 * Description of TypeListOptions
 *
 * @author      Thomas Pluess
 * @version     0.0.1
 * @since       0.0.1
 */
class TypeListOptions extends AbstractLoadableModel
{

    /**
     * @var     boolean                 True if the new instances should be stored
     *                                  instead of their class name.
     */
    protected $isCached;

    /**
     * Get the <code>isCached</code> flag.
     *
     * @return  boolean                 True if the new instances should be stored
     *                                  instead of their class name.
     */
    public function getIsCached()
    {
        return $this->isCached;
    }

    /**
     * Set the <code>isCached</code> flag.
     *
     * @param   boolean $isCached       True if the new instances should be stored
     *                                  instead of their class name.
     * @return  void
     */
    public function setIsCached(bool $isCached)
    {
        $this->isCached = $isCached;
    }

}

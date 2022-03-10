<?php

namespace Ht7\Base\Validation\Lists;

use \Ht7\Base\Lists\ItemList;

/**
 * Abstract base list class for validation element containers.
 *
 * @author      Thomas Pluess
 * @version     0.0.1
 * @since       0.0.1
 */
abstract class AbstractValidationList extends ItemList
{

    /**
     * Create an instance of the <code>AbstractValidationList</code> class.
     *
     * @param   array   $data           The items to add to the list of the new
     *                                  instance.
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

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

    public function load(array $data)
    {
        foreach ($data as $key => $value) {
            if (is_string($value) || is_object($value)) {
                $this->items[$key] = $value;
            }
        }
    }

    /**
     * Set the <code>isCached</code> flag.
     *
     * @param   boolean $isCached       True if the new instances should be stored
     *                                  instead of their class name.
     * @return  void
     */
    public function setIsCached($isCached)
    {
        $this->isCached = $isCached ? true : false;
    }

}

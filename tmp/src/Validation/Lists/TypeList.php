<?php

namespace Ht7\Base\Validation\Lists;

use \Ht7\Base\Validation\Lists\AbstractValidationList;
use \Ht7\Base\Validation\Options\TypeListOptions;

/**
 * List for defined validation types.
 *
 * @author      Thomas Pluess
 * @version     0.0.1
 * @since       0.0.1
 */
class TypeList extends AbstractValidationList
{

    /**
     * @var     TypeListOptions         The options of the type list.
     */
    protected $options;

    /**
     * Create an instance of the <code>TypeList</code> class.
     *
     * @param   array   $data           An assoc array of the types.
     * @param   array   $options
     */
    public function __construct(array $data = [], array $options = [])
    {
        $opt = array_merge($this->getDefaults(), $options);

        $this->setOptions($this->createOptionsFromArray($opt));

        parent::__construct($data);
    }

    public function createOptionsFromArray(array $options)
    {
        return new TypeListOptions($options);
    }

    public function get($index)
    {
        $item = parent::get($index);

        if (is_string($item)) {
            $item = new $item();

            if ($this->getOptions()->getIsCached()) {
                $this->items[$index] = $item;
            }
        }

        return $item;
    }

    /**
     * Get the default options.
     *
     * @return  array                   Assoc array of option name/option default value.
     */
    public function getDefaults()
    {
        return [
            'isCached' => true
        ];
    }

    /**
     *
     * @return  TypeListOptions
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     *
     * @param TypeListOptions $options
     */
    public function setOptions(TypeListOptions $options)
    {
        $this->options = $options;
    }

}

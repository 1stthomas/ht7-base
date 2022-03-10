<?php

namespace Ht7\Base\Validation;

use \Ht7\Base\Validation\ValidationContainerable;
use \Ht7\Base\Validation\Lists\AbstractValidationList;
use \Ht7\Base\Validation\Options\BaseOptionable;

/**
 * Abstract implementation of a base validation container. This base is used by
 * the validators and the validation types.
 *
 * @author      Thomas Pluess
 * @version     0.0.1
 * @since       0.0.1
 */
abstract class AbstractValidationContainer implements ValidationContainerable
{

    /**
     * @var     string                      The container id.
     */
    protected $hash;

    /**
     * @var     AbstractValidationList      The validation type list.
     */
    protected $list;

    /**
     * @var     BaseOptionable
     */
    protected $options;

    /**
     * Create an instance of the <code>AbstractValidator</code> class.
     *
     * @param   array   $items              Assoc array of type names/type class
     *                                      definition pairs.
     */
    public function __construct(array $items, $options)
    {
        if (is_array($options)) {
            $options = $this->createOptionsFromArray($options);
        } else if (!($options instanceof BaseOptionable)) {
            $e = 'The options parameter has to be an array or an instance of'
                    . ' ' . BaseOptionable::class . '.';

            throw \InvalidArgumentException($e);
        }

        $this->setOptions($options);

        if ($options->getIsMerged()) {
            $items = array_merge($this->getDefaults(), $items);
        }

        $this->setList($this->createListFromArray($items));
    }

    /**
     * {@inheritdoc}
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * {@inheritdoc}
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * {@inheritdoc}
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * {@inheritdoc}
     */
    public function setList(AbstractValidationList $list)
    {
        $this->list = $list;
    }

    /**
     * {@inheritdoc}
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

}

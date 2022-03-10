<?php

namespace Ht7\Base\Messages\Types;

use \Ht7\Base\Lists\Hashable;
use \Ht7\Base\Messages\Options\BaseOptions;

/**
 * Description of BaseType
 *
 * @author Thomas Pluess
 */
abstract class AbstractBaseType implements Hashable
{

    protected $options;
//    protected $strings;
    protected $type;

    public function __construct(BaseOptions $options)
    {
        $this->setOptions($options);
    }

    abstract public function text();

    public function getHash()
    {
        return $this->type;
    }

    /**
     *
     * @return  BaseOptions
     */
    public function getOptions()
    {
        return $this->options;
    }

//
//    public function getStrings()
//    {
//        if (empty($this->getStrings())) {
//            $this->strings = $this->getOptions()->getStringsClass()();
//        }
//
//        return $this->strings;
//    }

    public function getTranslator()
    {
        if (is_string($this->getOptions()->getTranslator())) {
            $this->getOptions()->setTranslator((new ($this->getOptions()->getTranslator())()));
        }

        return $this->getOptions()->getTranslator();
    }

    public function getType()
    {
        return $this->type;
    }

    public function setOptions(BaseOptions $options)
    {
        $this->options = $options;
    }

//
//    public function setStrings($strings)
//    {
//        $this->strings = $strings;
//    }

    public function setType($type)
    {
        $this->type = $type;
    }

}

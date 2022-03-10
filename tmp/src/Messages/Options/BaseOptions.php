<?php

namespace Ht7\Base\Messages\Options;

use \Ht7\Base\Messages\Options\Optionable;
use \Ht7\Base\Models\AbstractLoadableModel;

/**
 * Description of BaseOptions
 *
 * @author Thomas Pluess
 */
class BaseOptions extends AbstractLoadableModel implements Optionable
{

    protected $optionsClass;
    protected $patternsClass;
    protected $translator;
    protected $type;
    protected $typeClass;

    public function __construct(array $data = [])
    {
        $this->setupDefaults();

        parent::__construct($data);
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaults()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getOptionsClass()
    {
        return $this->optionsClass;
    }

    /**
     * {@inheritdoc}
     */
    public function getPatternsClass()
    {
        return $this->patternsClass;
    }

    /**
     * {@inheritdoc}
     */
    public function getTranslator()
    {
        return $this->translator;
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function getTypeClass()
    {
        return $this->typeClass;
    }

    /**
     * {@inheritdoc}
     */
    public function setOptionsClass($optionsClass)
    {
        $this->optionsClass = $optionsClass;
    }

    /**
     * {@inheritdoc}
     */
    public function setPatternsClass($patternsClass)
    {
        $this->patternsClass = $patternsClass;
    }

    /**
     * {@inheritdoc}
     */
    public function setTranslator($translator)
    {
        $this->translator = $translator;
    }

    /**
     * {@inheritdoc}
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function setTypeClass($typeClass)
    {
        $this->typeClass = $typeClass;
    }

    protected function setupDefaults()
    {
        $this->load($this->getDefaults());
    }

}

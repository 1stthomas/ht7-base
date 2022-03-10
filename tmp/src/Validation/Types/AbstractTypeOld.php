<?php

namespace Ht7\Base\Validation\Types;

use \Ht7\Base\Validation\Lists\RuleList;
use \Ht7\Base\Validation\Types\ValidationTypable;

/**
 * Description of Abstract Type
 *
 * @author      Thomas Pluess
 * @version     0.0.1
 * @since       0.0.1
 */
abstract class AbstractTypeOld implements ValidationTypable
{

    /**
     * @var     RuleList
     */
    protected $ruleList;

    /**
     * @var     int
     */
    protected $type;

    /**
     * Create an instance of the <code>AbstractType</code> class.
     *
     * @param   array   $rules              Assoc array with the rules definitions.
     */
    public function __construct(array $rules = [], bool $isMerged = true)
    {
        $rulesMerged = $isMerged ? array_merge($this->getDefaults(), $rules) : $rules;

        $this->setRuleList($this->createRuleListFromArray($rulesMerged));
    }

    /**
     * {@inheritdoc}
     */
    public function createRuleListFromArray(array $rules)
    {
        return new RuleList($rules);
    }

    /**
     * {@inheritdoc}
     */
    public function getHash()
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function getRuleList()
    {
        return $this->ruleList;
    }

    /**
     * {@inheritdoc}
     */
    public function handleValidationFail($value, string $name, string $check, $options)
    {
        if ($options->getBase()->getThrowOnFail()) {

        }
    }

    /**
     * {@inheritdoc}
     */
    public function setRuleList(RuleList $ruleList)
    {
        $this->ruleList = $ruleList;
    }

}

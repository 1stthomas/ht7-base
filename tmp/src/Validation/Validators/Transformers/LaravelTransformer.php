<?php

namespace Ht7\Base\Validation\Validators\Transformers;

use \Ht7\Base\Validation\Lists\TypeList;

/**
 * This is an abstract implementation of a base validator. This class does not
 * define any validation method.
 *
 * @author      Thomas Pluess
 * @version     0.0.1
 * @since       0.0.1
 */
class LaravelTransformer
{

    protected $delimiter;
    protected $typeList;

    public function __construct($typeList)
    {
        $this->setDelimiter('|');
        $this->setTypeList($typeList);
    }

    public function createTypeListFromArray(array $rules)
    {
        $arr = [];
        $trans = $this->getLaravelToHt7();
        $tLOrg = $this->getTypeList();

        foreach ($rules as $rule) {
            $name = explode(':', $rule)[0];

            if (array_key_exists($name, $trans)) {
                $arr[] = $tLOrg->get($name);
            }
        }

        $tL = new TypeList($arr);

        return $tL;
    }

    public function createTypeListFromString(string $rules)
    {
        $arr = explode($this->getDelimiter(), $rules);

        return $this->createTypeListFromArray($arr);
    }

    public function getDelimiter()
    {
        return $this->delimiter;
    }

    public function getLaravelToHt7()
    {
        return [
            'accepted' => 'accepted',
            'required' => 'required'
        ];
    }

    public function getTypeList()
    {
        return $this->typeList;
    }

    public function setDelimiter($delimiter)
    {
        $this->delimiter = $delimiter;
    }

    public function setTypeList($typeList)
    {
        $this->typeList = $typeList;
    }

}

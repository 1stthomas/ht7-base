<?php

namespace Ht7\Base\Validation\Validators;

use \Ht7\Base\Validation\Options\BaseOptions;
use \Ht7\Base\Validation\Types\MultiValueValidationable;
use \Ht7\Base\Validation\Types\SingleValueValidationable;
use \Ht7\Base\Validation\Validators\AbstractValidator;
use \Ht7\Base\Validation\Validators\MultiValueValidationable;
use \Ht7\Base\Validation\Validators\Transformers\LaravelTransformer;

/**
 * This is an abstract implementation of a base validator. This class does not
 * define any validation method.
 *
 * @author      Thomas Pluess
 * @version     0.0.1
 * @since       0.0.1
 */
class LaravelSyntaxValidator extends AbstractValidator implements MultiValueValidationable
{

    protected $transformer;

    public function __construct(array $items, $options)
    {
        $this->hash = 'laravel_syntax';

        parent::__construct($items, $options);
    }

    public function checkItemRules(string $name, $values, $rules)
    {
        if (is_string($rules)) {
            $tL = $this->getTransformer()->createTypeListFromString($rules);
        } elseif (is_array($rules)) {
            $tL = $this->getTransformer()->createTypeListFromString($rules);
        } elseif (!is_array($rules)) {
            throw new InvalidArgumentException('The rules need to be an array or string.');
        }

        foreach ($tL as $key => $type) {
            if ($type instanceof SingleValueValidationable) {
                $type->validate($values[$name], $rules, []);
            } elseif ($type instanceof MultiValueValidationable) {
                $type->validate($values, $rules, []);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function createOptionsFromArray(array $options)
    {
        return new BaseOptions($options);
    }

    public function getTransformer()
    {
        if (empty($this->transformer)) {
            $this->transformer = new LaravelTransformer($this->getList());
        }

        return $this->transformer;
    }

    public function validate(array $values, array $rules, array $options = [])
    {
        foreach ($rules as $name => $itemRules) {
            $result = $this->checkItemRules($name, $values, $itemRules);
        }
    }

}

<?php

namespace Ht7\Base\Validation\Validators;

/**
 *
 * @author Thomas Pluess
 */
interface MultiValueValidationable
{

    public function validate(array $values, array $rules, array $options = []);
}

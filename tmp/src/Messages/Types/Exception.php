<?php

namespace Ht7\Base\Messages\Types;

use \Ht7\Base\Messages\MessageTypes;
use \Ht7\Base\Messages\Types\AbstractBaseType;
//use \Ht7\Base\Messages\Options\BaseOptions;
use \Ht7\Base\Messages\Options\Exception as Options;

/**
 * Description of Exception
 *
 * @author Thomas Pluess
 */
class Exception extends AbstractBaseType
{

    public function __construct(Options $options)
    {
        $this->type = MessageTypes::EXCEPTION;

        parent::__construct($options);
    }

    public function text()
    {

    }

}

<?php

namespace Ht7\Base\Exceptions;

use \Exception;
use \Psr\Container\NotFoundExceptionInterface;

/**
 * Description of NotFoundException
 *
 * @author Thomas Pluess
 */
class EntryNotFoundException extends Exception implements NotFoundExceptionInterface
{

}

<?php

namespace Ht7\Base\Messages\Options;

use \Ht7\Base\Messages\MessageTypes;
use \Ht7\Base\Messages\Options\BaseOptions;
use \Ht7\Base\Messages\Patterns\Exception as ExceptionPattern;
use \Ht7\Base\Messages\Types\Exception as ExceptionType;

/**
 * Description of BaseOptions
 *
 * @author Thomas Pluess
 */
class Exception extends BaseOptions
{

    /**
     * @var     string          The index of the text pattern to take.
     */
    protected $index;
    protected $parts;

    public function __construct(array $data = [])
    {
        $this->type = MessageTypes::EXCEPTION;

        parent::__construct($data);
    }

    public function getDefaults()
    {
        return array_merge(parent::getDefaults(), [
            'patternsClass' => ExceptionPattern::class,
            'typeClass' => ExceptionType::class
        ]);
    }

    public function getIndex()
    {
        return $this->index;
    }

    public function getParts()
    {
        return $this->parts;
    }

    public function setIndex(string $index)
    {
        $this->index = $index;
    }

    public function setParts(object $parts)
    {
        $this->parts = $parts;
    }

}

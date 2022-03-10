<?php

namespace Ht7\Base\Messages;

use \Ht7\Base\Lists\HashList;
use \Ht7\Base\Messages\Options\BaseOptions;

/**
 * Description of Composer
 *
 * @author Thomas Pluess
 */
class Composer extends HashList
{

    /**
     * @var     array               Assoc array of the resolved options.
     */
    protected $items;

    public function __construct(array $types)
    {
        parent::__construct($types);
    }

    public function compose($options)
//    public function compose(int $type, int $typeItem, array $options)
    {
        if (is_array($options)) {
            $this->resolve($options);
        }

        if ($options instanceof BaseOptions) {

        } else {
            throw new \InvalidArgumentException('Invalid datatype.');
        }
    }

    public function load(array $types)
    {
        foreach ($types as $typeKey => $type) {
            if (is_string($type)) {

            }

            $this->add($type);
        }
    }

    public function reslove(array $options)
    {
        if ($this->has($options['index'])) {
            $this->get($options['index'])->load($options);
        } else {

        }

        return $this->get($options['index']);
    }

}

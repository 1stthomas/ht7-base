<?php

namespace Ht7\Base;

use \Ht7\Base\ContainerLwable;
use \Ht7\Base\Exceptions\ContainerResolvingException;
use \Ht7\Base\Exceptions\EntryNotFoundException;

/**
 * Description of Container
 *
 * @author Thomas Pluess
 */
class ContainerLw implements ContainerLwable
{
    public $test;
    protected $bindings;
    protected $instances;
    protected static $instance;

    public function __construct()
    {
        $this->test = 'test';
        $this->bindings = [];
        $this->instances = [];

        $this->bind('exc/container/psr/container', ContainerResolvingException::class);
        $this->bind('exc/container/psr/notfound', EntryNotFoundException::class);
    }
    public static function getInstance()
    {
        if (empty(self::$instance)) {
            static::$instance = new static();
        }

        return static::$instance;
    }
    /**
     * {@inheritdoc}
     */
    public function bind($abstract, $concrete = null, $shared = true)
    {
        $this->bindings[$abstract] = $concrete;
    }
    /**
     * Alias of <code>ContainerLw::has($abstract)</code>
     *
     * {@inheritdoc}
     */
    public function bound($abstract)
    {
        return $this->has($abstract);
    }
    /**
     * Get the binding of the present abstract.
     *
     * {@inheritdoc}
     */
    public function get($abstract)
    {
        return $this->resolve($abstract);
    }
    public function getBindings()
    {
        return $this->bindings;
    }
    public function getInstances()
    {
        return $this->instances;
    }
    /**
     * {@inheritdoc}
     */
    public function has($abstract)
    {
        return array_key_exists($abstract, $this->getBindings());
    }
    /**
     * {@inheritdoc}
     */
    public function instance($abstract, $instance)
    {
        $this->bind($abstract, get_class($instance), true);

        $this->instances[$abstract] = $instance;
    }
    /**
     * {@inheritdoc}
     */
    public function make($abstract, $parameters = [])
    {
        return $this->resolve($abstract, $parameters);
    }
    public function reset()
    {
        $this->bindings = [];
        $this->instances = [];
    }
    public function resolve($abstract, $parameters = [])
    {
        if ($this->has($abstract)) {
            $instances = $this->getInstances();

            if (array_key_exists($abstract, $instances)) {
                return $instances[$abstract];
            } else {
                $class = $this->getBindings()[$abstract];

                try {
                    if (is_callable($class)) {
                        $instances[$abstract] = $class(...$parameters);
                    } elseif (!count($parameters)) {
                        $instances[$abstract] = new $class();
                    } elseif (count($parameters) === 1) {
                        $instances[$abstract] = new $class($parameters[0]);
                    } else {
                        $instances[$abstract] = new $class(...$parameters);
                    }
                } catch (\Exception $e) {
                    $class = $this->getBindings()['exc/container/psr/container'];
                    throw new $class($e->getMessage(), $e->getCode(), $e);
                }
            }
        } else {
            $class = $this->getBindings()['exc/container/psr/notfound'];
            throw new $class();
        }
    }
    /**
     * {@inheritdoc}
     */
    public function singleton($abstract, $concrete = null)
    {
        $this->bind($abstract, $concrete, true);
    }
}

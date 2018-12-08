<?php

namespace Ht7\Base;

use \BadMethodCallException;
use \InvalidArgumentException;
use \JsonSerializable;
use \OutOfBoundsException;
use \Serializable;
use Ht7\Base\OrOptionsInterface;

class ObjectRestricted implements Serializable, JsonSerializable
{

    /**
     *
     * @var     OrOptionsAbstract
     */
    protected $orOptions;

    public function __construct($data = [], OrOptionsInterface $options = null)
    {
        if (empty($options)) {
            $this->getOrOptions();
        } else {
            $this->orOptions = $options;
        }

        if (!empty($data)) {
            $this->load($data);
        }
    }

    /**
     * Handle all calls to inexistent methods.
     *
     * @param   string  $name
     * @param   type    $args
     * @return  mixed
     * @throws BadMethodCallException
     */
    public function __call($name, $args)
    {
        if (strlen($name) > 3) {
            $varRequest = lcfirst(substr($name, 3));

            if ($this->isCallGet($name)) {
                if ($this->hasVar($varRequest)) {
                    return $this->$varRequest;
                }
            } elseif ($this->isCallSet($name)) {
                if ($this->hasVar($varRequest)) {
                    $this->$varRequest = $args[0];
                    return;
                }
            }
        }

        $msg = sprintf('Call to undefined method %s.', $name);
        // original PHP message: "Call to undefined method XYZ at [line no]"
        throw new BadMethodCallException($msg);
    }

    public function __set($name, $args)
    {
        if ($this->orOptions->lockProperties) {
            $msg = sprintf('Undefined property: "%s"', $name);

            throw new OutOfBoundsException($msg);
        } else {
            $this->$name = $args;
        }
    }

    /**
     * Return the options.
     *
     * If the options is empty, an anonymous class instance which implements the
     * <code>OrOptionsInterface</code> will be created.
     *
     * @return  OrOptionsAbstract   An implementation which provides the options
     *                              for the current instance.
     */
    public function getOrOptions()
    {
        if (empty($this->orOptions)) {
            // Create a default one.
            $this->orOptions = OrOptionsFactory::getOrOptionRestricted();
        }

        return $this->orOptions;
    }

    /**
     * Return an array with predefined object properties. Called by
     * <code>json_encode()</code> which transforms the value into an json string.
     *
     * @return  array
     */
    public function jsonSerialize()
    {
        $orOptions = $this->getOrOptions();
        $vars = get_object_vars($this);
        unset($vars['orOptions']);

        if ($orOptions->hasExportVars) {
            $exportVars = $orOptions->getExportVars();
            $arr = $this->toArrayWith($vars, $exportVars);
        } else {
            $arr = $this->toArrayWithout($vars);
        }

        return $arr;
    }

    /**
     * Load the commited data into the current instance.
     *
     * @param   mixed       $data   The data to import. It can be an assoc
     *                              array or a string of an serialized object.
     * @throws Exception
     */
    public function load($data)
    {
        if (is_string($data)) {
            $this->unserialize($data);
        } elseif (is_array($data) || is_object($data)) {
            $this->loadObject($data);
        } else {
            throw new Exception('Wrong data type: ' . gettype($data) . ' found - array or string needed', E_USER_ERROR);
        }
    }

    /**
     * Load the data of an array or object into the current instance.
     *
     * @param   mixed   $data       Assoc array or object with the
     *                              variables to import.
     */
    public function loadObject($data)
    {
        $exportVars = $this->orOptions->getExportVars();
        $arr = [];

        if ($this->orOptions->hasExportVars) {
            $this->loadObjectWith($data, $exportVars, $arr);
        } else {
            $this->loadObjectWithout($data, $arr);
        }
    }

    /**
     * Serialize the current instance by checking if there is a set method of the variable.<br />
     * The set method has to have the pattern as following:<br />
     * setVariableName() - with an uppercase first letter of the variable.
     *
     * @return  string          The serialized object.
     */
    public function serialize()
    {
        return serialize($this->jsonSerialize());
    }

    /**
     * Set the options.
     *
     * @return  OrOptionsAbstract   An implementation which provides the options
     *                              for the current instance.
     */
    public function setOrOptions(OrOptionsAbstract $orOptions)
    {
        $this->orOptions = $orOptions;
    }

    /**
     * Unserialize the submitted data and fill the current instance with the data.
     *
     * @param   string      $data           A serialized string of an instance
     *                                      of an extender of this class.
     * @throws  Exception
     */
    public function unserialize($data)
    {
        if (is_string($data)) {
            $unserialized = unserialize($data);
            $this->load($unserialized);
        } else {
            $msg = 'Wrong data type. String needed, ';
            $msg .= 'found %s.';
            $e = sprintf($msg, gettype($data));

            throw new InvalidArgumentException($e);
        }
    }

    /**
     * Check if the current instance has a property with the submitted name.
     *
     * @param   string  $name       The name to check if a property with this
     *                              name exists.
     * @return  boolean             True if the property exists.
     */
    protected function hasVar($name)
    {
        return key_exists($name, get_object_vars($this));
    }

    /**
     * Check if the submitted name starts with "get".
     *
     * @param   string  $name       The string to be checked.
     * @return  boolean             True if the submitted name starts with "get".
     */
    protected function isCallGet($name)
    {
        return strpos($name, 'get') === 0;
    }

    /**
     * Check if the submitted name starts with "set".
     *
     * @param   string  $name       The string to be checked.
     * @return  boolean             True if the submitted name starts with "set".
     */
    protected function isCallSet($name)
    {
        return strpos($name, 'set') === 0;
    }

    protected function loadObjectWith(array $data, array $exportVars, array $arr = [])
    {
        foreach ($data as $name => $value) {
            if (in_array($name, $exportVars)) {
                $this->$name = $value;
            }
        }

        return $arr;
    }

    protected function loadObjectWithout(array $data, array $arr = [])
    {
        foreach ($data as $name => $value) {
            $this->$name = $value;
        }

        return $arr;
    }

    protected function toArrayWith(array $vars, array $exportVars, array $arr = [])
    {
        if (empty($exportVars)) {
            foreach ($vars as $name => $value) {
                $arr[$name] = $value;
            }
        } else {
            foreach ($vars as $name => $value) {
                if (in_array($name, $exportVars)) {
                    $arr[$name] = $value;
                }
            }
        }

        return $arr;
    }

    protected function toArrayWithout(array $arr = [])
    {
        $vars = get_object_vars($this);

        foreach ($vars as $key => $value) {
            $arr[$key] = $value;
        }
    }

}

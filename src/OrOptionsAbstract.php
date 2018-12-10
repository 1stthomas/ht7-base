<?php

namespace Ht7\Base;

use \InvalidArgumentException;
use \OutOfBoundsException;
use \JsonSerializable;
use \Serializable;

/**
 * Description of OrOptionsAbstract
 *
 * @author 1stthomas
 */
abstract class OrOptionsAbstract implements JsonSerializable, OrOptionsInterface, Serializable
{

    /**
     * Whetever the <code>$exportVars</code> is set or not.
     *
     * @var     boolean     True if the export variable restriction is activated.
     */
    public $hasExportVars = false;

    /**
     * Set this property to true to restrict the import/export
     * to variables with an associated method.<br />
     *
     * If the <code>exportVars</code> property has entries, only the present
     * properties will be restricted. Otherwise all properties will respect the
     * current restriction.
     *
     * @var     boolean     True if the method restriction is activated.
     */
    public $hasMethodRestriction = false;

    /**
     * Set this property to true to restrict the import/export
     * to variables with an explicit class variable declaration.
     *
     * @var     boolean     True if the variable restriction is activated.
     */
    public $hasVarRestriction = false;

    /**
     * Set this property to true to avoid adding undefined
     * properties to the \Ht7\Base\ObjectRestricted instance.
     *
     * By default PHP objects can store inexistent properties. This can lead to
     * bugs, which are difficult to find.<br />
     * If this property is set to true, an <code>OutOfBoundsException</code>
     * will be thrown, when someone tries to assign an inexistent property to
     * the underlying instance.
     *
     * @var     boolean     True if assigning inexistent properties to the
     *                      underlying instance should be prohibited.
     */
    public $lockProperties = true;

    /**
     * If not empty these variable names are used by export methods.
     *
     * @var     array    Indexed array
     */
    private $exportVars = [];

    public function __construct(array $data = [])
    {
        $this->load($data);
    }

    /**
     * It is prohibited to assign a value to an undefined property.
     *
     * @param   string  $name       The name of the inexistent property.
     * @param   mixed   $value      The value which should be assigned to the
     *                              inexistent property.
     * @throws OutOfBoundsException
     */
    public function __set($name, $value)
    {
        $msg = sprintf('Undefined property: "%s"', $name);

        throw new OutOfBoundsException($msg);
    }

    /**
     * {@inheritDoc}
     */
    public function addExportVar($name)
    {
        $this->exportVars[] = $name;
        $this->hasExportVars = true;
    }

    /**
     * {@inheritDoc}
     */
    public function getExportVars()
    {
        return $this->exportVars;
    }

    /**
     * Return an array with predefined object properties. Called by
     * <code>json_encode()</code> which transforms the value into an json string.
     *
     * @return  array
     */
    public function jsonSerialize()
    {
        $arr = get_object_vars($this);

        $arr['exportVars'] = $this->getExportVars();

        return $arr;
    }

    /**
     * Load the object properties from array.
     *
     * @param   array   $data
     */
    public function load(array $data = [])
    {
        foreach ($data as $name => $value) {
            if ($name === 'exportVars') {
                $this->$name = $value;
            } else {
                $this->$name = boolval($value);
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    public function serialize()
    {
        return serialize($this->jsonSerialize());
    }

    /**
     * {@inheritDoc}
     */
    public function setExportVars(array $arr)
    {
        $this->exportVars = $arr;
        $this->hasExportVars = true;
    }

    /**
     * {@inheritDoc}
     */
    public function unserialize($data)
    {
        if (is_string($data)) {
            $unserialized = unserialize($data);

            $vars = get_object_vars($this);
            $names = array_keys($vars);

            foreach ($unserialized as $name => $value) {
                if (in_array($name, $names)) {
                    $this->$name = $value;
                } else {
                    $msg = 'Found unsupported property %s';
                    $e = sprintf($msg, $name);

                    throw new InvalidArgumentException($e);
                }
            }
        } else {
            $msg = 'Wrong data type. String needed, ';
            $msg .= 'found %s.';
            $e = sprintf($msg, gettype($data));

            throw new InvalidArgumentException($e);
        }
    }

}

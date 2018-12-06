<?php

namespace Ht7\Base;

use \BadMethodCallException;

class Ht7Object
{
    public function __construct(array $data = [], $options = [])
    {
        
    }
    
    /**
     * Handle all calls to inexistent methods.
     * 
     * @param type $name
     * @param type $args
     * @return type
     * @throws BadMethodCallException
     * 
     * @assert ('setTest', 'test') == false
     */
    public function __call($name, $args)
    {
        if ($this->isCallGet($name) && $this->hasVarByMethodName($name)) {
            return $this->handleCallGet($name);
        } elseif ($this->isCallSet($name) && $this->hasVarByMethodName($name)) {
            return $this->handleCallSet($name, $args);
        } else {
            $msg = 'The method ' . $name . ' is not supported.';
            // original PHP message: "Call to undefined method XYZ at [line no]"
            throw new BadMethodCallException($msg);
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
        $vars = get_class_vars(static::class);
        
        foreach ($vars as $key => $var) {
            if ($name === $key) {
                return true;
            }
        }
        
        return false;
    }
    
    /**
     * Check if a variable exists from a getXXX or setYYY method name.
     * 
     * @param   string  $methodName     The method name from which the property
     *                                  name will be retrived.
     * @return  boolean                 True if a property with the specified
     *                                  name by the submitted method name exists.
     */
    protected function hasVarByMethodName($methodName)
    {
        $varRequest  = lcfirst(substr($methodName, 3));
        
        return $this->hasVar($varRequest);
    }
    
    protected function handleCallGet($name)
    {
        $var = strtolower(substr($name, 3));
        
        return $this->$var;
    }
    
    protected function handleCallSet($name, array $args)
    {
        $var = strtolower(substr($name, 3));
        
        $this->$var = $args[0];
    }
    
    protected function isCallGet($name)
    {
        return strpos($name, 'get') !== false;
    }
    
    protected function isCallSet($name)
    {
        return strpos($name, 'set') !== false;
    }
}

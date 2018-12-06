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
     */
    public function __call($name, $args)
    {
        if (strlen($name) > 3) {
            $varRequest  = lcfirst(substr($name, 3));
            
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
        
        $msg = 'The method ' . $name . ' is not supported.';
        // original PHP message: "Call to undefined method XYZ at [line no]"
        throw new BadMethodCallException($msg);
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
        
        return key_exists($name, $vars);
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

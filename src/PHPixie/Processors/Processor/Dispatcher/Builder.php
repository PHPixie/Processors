<?php

namespace PHPixie\Processors\Processor\Dispatcher;

abstract class Builder extends \PHPixie\Processors\Processor\Dispatcher
{
    protected $processors = array();
    
    public function processor($name)
    {
        if(!array_key_exists($name, $this->processors)) {
            $method = 'build'.ucfirst($name).'Processor';
            if(!method_exists($this, $method)) {
                return null;
            }
            $this->processors[$name] = $this->$method();
        }
        
        return $this->processors[$name];
    }
}
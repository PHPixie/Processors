<?php

namespace PHPixie\Processors\Processor;

abstract class Dispatcher implements Selective
{
    public function process($value)
    {
        $processor = $this->getProcessorFor($value);
        if($processor === null) {
            throw new \PHPixie\Processors\Exception("No processor found for value");
        }
        
        return $processor->process($value);
    }
    
    public function isProcessable($value)
    {
        $processor = $this->getProcessorFor($value);
        return $processor !== null;
    }
    
    protected function getProcessorFor($value)
    {
       $name = $this->getProcessorNameFor($value);
        if($name === null) {
            return null;
        }
        
        $processor = $this->processor($name);
        if($processor instanceof Selective) {
            if(!$processor->isProcessable($value)) {
                return null;
            }
        }
        
        return $processor;
    }
    
    abstract public function processor($name);
    abstract protected function getProcessorNameFor($value);
}
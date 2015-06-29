<?php

namespace PHPixie\Processors\Processor;

class Chain implements \PHPixie\Processors\Processor
{
    protected $processors;
    
    public function __construct($processors)
    {
        $this->processors = $processors;
    }
    
    public function process($value)
    {
        foreach($this->processors as $processor) {
            $value = $processor->process($value);
        }
        
        return $value;
    }
}
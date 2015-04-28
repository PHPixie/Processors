<?php

namespace PHPixie\Processors\Processor;

class Chain implements \PHPixie\Processors\Processor
{
    protected $registries;
    
    public function __construct($registries)
    {
        $this->registries = $registries;
    }
    
    public function process($configData, $value)
    {
        foreach($configData as $processorConfig)
        {
            $type   = $processorConfig->getRequired('processor');
            $config = $processorConfig->slice('config');
            
            $processor = $this->registries->processor($type);
            $value = $processor->process($config, $value);
        }
        
        return $value;
    }
    
    public function name()
    {
        return 'chain';
    }
}
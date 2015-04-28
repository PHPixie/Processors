<?php

namespace PHPixie\Processors\Processor;

class Chain implements \PHPixie\Processors\Processor
{
    protected $registries;
    
    public function process($configData, $value)
    {
        foreach($configData as $processorConfig)
        {
            $type   = $configData->getRequired('processor');
            $config = $configData->slice('config');
            
            $processor = $this->registries->getProcessor($type);
            $value = $processor->process($config, $value);
        }
        
        return $value;
    }
}
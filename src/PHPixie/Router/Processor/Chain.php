<?php

namespace PHPixie\Router\Processor;

class Chain implements \PHPixie\Router\Processor
{
    protected $processors;
    
    public function process($configData, $value)
    {
        foreach($configData as $processorConfig)
        {
            $type   = $configData->getRequired('processor');
            $config = $configData->slice('config');
            
            $processor = $this->processors->get($type);
            $value = $processor->process($config, $value);
        }
        
        return $value;
    }
}
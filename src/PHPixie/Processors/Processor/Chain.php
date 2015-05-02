<?php

namespace PHPixie\Processors\Processor;

class Chain implements \PHPixie\Processors\Processor
{
    protected $registries;
    protected $configData;
    protected $processors;
    
    public function __construct($registries, $configData)
    {
        $this->registries = $registries;
        $this->configData = $configData
    }
    
    public function process($configData, $value)
    {
        foreach($this->processors() as $processor)
        {
            $value = $processor->process($config, $value);
        }
        
        return $value;
    }
    
    protected function processors()
    {
        if($this->processors === null) {
            $this->processors = array();
            foreach($this->configData as $processorConfig) {
                $type   = $processorConfig->getRequired('processor');
                $config = $processorConfig->slice('config');
                $this->processors[]= $this->registries->processor($type);
            }
        }   
    }
    
    public function name()
    {
        return 'chain';
    }
}
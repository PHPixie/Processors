<?php

namespace PHPixie\Process;

interface Processors
{
    protected $registries;
    protected $processorMap;
    
    public function __construct($registries = array())
    {
        foreach($registries as $registry) {
            $registryName = $registry->name();
            $this->registries[$registryName] = $registry;
            foreach($registry->processorNames() as $name) {
                $this->processorMap[$name] = $registryName;
            }
        }
    }
    
    public function getProcessor($name)
    {
        $registryName = $this->processorMap[$name];
        $registry = $this->registry($registryName);
        return $registry->get($name);
    }
    
    public function registry($name)
    {
        return $this->registries[$name];
    }
}
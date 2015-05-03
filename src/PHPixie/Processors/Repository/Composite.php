<?php

namespace PHPixie\Processors\Repository;

class Composite implements \PHPixie\Processors\Repository
{
    protected $repositoryMap;
    
    public function __construct($repositoryMap)
    {
        $this->repositoryMap = $repositoryMap;
    }
    
    public function get($name)
    {
        $parts = explode('.', $name, 2);
        
        if(count($parts) !== 2) {
            throw new \PHPixie\Processors\Exception("Invalid processor name '$name' specified.");
        }
        
        $repository = $this->repository($parts[0]);
        return $repository->get($parts[1]);
    }
    
    public function repository($name)
    {
        if(!array_key_exists($name, $this->repositoryMap)) {
            throw new \PHPixie\Processors\Exception("Processor repository '$name' not found");
        }
        
        return $this->repositoryMap[$name];
    }
}
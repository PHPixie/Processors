<?php

namespace PHPixie\Processors\Repository;

class Composite implements \PHPixie\Processors\Repository
{
    protected $repositoryMap;
    protected $defaultRepositoryName;
    
    public function __construct($repositoryMap, $defaultRepositoryName = null)
    {
        $this->repositoryMap = $repositoryMap;
        $this->defaultRepositoryName = $defaultRepositoryName;
    }
    
    public function get($name)
    {
        $parts = explode('.', $name, 2);
        $count = count($parts);
        
        if($count === 1) {
            if($this->defaultRepositoryName !== null) {
                array_unshift($parts, $this->defaultRepositoryName);
            }else{
                throw new \PHPixie\Processors\Exception("Invalid processor name '$name' specified.");
            }
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
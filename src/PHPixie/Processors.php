<?php

namespace PHPixie;

class Processors
{
    public function chain($processors)
    {
        return new Processors\Processor\Chain($processors);
    }
    
    public function compositeRepository($repositoryMap)
    {
        return new Processors\Repository\Composite($repositoryMap);
    }
}
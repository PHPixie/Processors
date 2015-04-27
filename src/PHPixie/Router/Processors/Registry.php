<?php

namespace PHPixie\Process\Processors;

class Registry
{
    public function $builderMap = array();
    
    public function __construct($processorBuilders)
    {
        foreach($processorBuilders as $builder) {
            $builderName = $builder->name();
            $this->builderMap[$builderName] = $builder;
        }
    }
}
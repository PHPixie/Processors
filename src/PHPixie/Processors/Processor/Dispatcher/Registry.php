<?php

namespace PHPixie\Processors\Processor\Dispatcher;

abstract class Registry extends \PHPixie\Processors\Processor\Dispatcher
{
    protected $registry;
    
    public function __construct($registry)
    {
        $this->registry = $registry;
    }
    
    public function processor($name)
    {
        return $this->registry->get($name);
    }
}
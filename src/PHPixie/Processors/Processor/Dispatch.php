<?php

namespace PHPixie\Processors\Processor;

class Dispatch
{
    protected $dispatcher;
    
    public function __construct($dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }
    
    public function process($request)
    {
        $processor = $this->dispatcher->getProcessorFor($request);
        return $processor->process($request);
    }
}
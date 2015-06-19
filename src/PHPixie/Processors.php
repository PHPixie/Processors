<?php

namespace PHPixie;

class Processors
{
    public function chain($processors)
    {
        return new Processors\Processor\Chain($processors);
    }
    
    public function dispatch($dispatcher)
    {
        return new Processors\Processor\Dispatch($dispatcher);
    }
    
    public function checkIsDispatchable($dispatcher, $foundProcessor, $notFoundProcessor)
    {
        return new Processors\Processor\CheckIsDispatchable(
            $dispatcher,
            $foundProcessor,
            $notFoundProcessor
        );
    }
    
    public function catchException($valueProcessor, $exceptionProcessor)
    {
        return new Processors\Processor\CatchException(
            $valueProcessor,
            $exceptionProcessor
        );
    }
}
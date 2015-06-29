<?php

namespace PHPixie;

class Processors
{
    public function chain($processors)
    {
        return new Processors\Processor\Chain($processors);
    }
    
    public function checkIsProcessable($processor, $processableProcessor, $notProcessableProcessor)
    {
        return new Processors\Processor\CheckIsProcessable(
            $processor,
            $processableProcessor,
            $notProcessableProcessor
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
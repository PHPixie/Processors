<?php

namespace PHPixie\Processors\Processor;

class CatchException implements \PHPixie\Processors\Processor
{
    protected $valueProcessor;
    protected $exceptionProcessor;
    
    public function __construct($valueProcessor, $exceptionProcessor)
    {
        $this->valueProcessor     = $valueProcessor;
        $this->exceptionProcessor = $exceptionProcessor;
    }
    
    public function process($value)
    {
        try {
            return $this->valueProcessor->process($value);

        } catch(\Throwable $exception) {
            return $this->exceptionProcessor->process($exception);

        } catch(\Exception $exception) {
            return $this->exceptionProcessor->process($exception);

        }
    }
}
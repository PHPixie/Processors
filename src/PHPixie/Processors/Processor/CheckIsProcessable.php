<?php

namespace PHPixie\Processors\Processor;

class CheckIsProcessable
{
    protected $processor;
    protected $processableProcessor;
    protected $notProcessableProcessor;
    
    public function __construct($processor, $processableProcessor, $notProcessableProcessor)
    {
        $this->processor               = $processor;
        $this->processableProcessor    = $processableProcessor;
        $this->notProcessableProcessor = $notProcessableProcessor;
    }
    
    public function process($value)
    {
        if($this->isProcessable($value)) {
            $processor = $this->processableProcessor;
            
        }else{
            $processor = $this->notProcessableProcessor;
        }
        
        return $processor->process($value);
    }
    
    protected function isProcessable($value)
    {
        if($this->processor instanceof Selective) {
            return $this->processor->isProcessable($value);
        }
        
        return true;
    }
}
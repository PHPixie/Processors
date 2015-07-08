<?php

namespace PHPixie\Processors\Processor;

abstract class Actions implements Selective
{
    public function process($value)
    {
        $method = $this->getMethodNameFor($value);
        
        if($method === null) {
            throw new \PHPixie\Processors\Exception("No action method found for value");
        }
        
        return $this->$method($value);
    }
    
    public function isProcessable($value)
    {
        $method = $this->getMethodNameFor($value);
        return $method !== null;
    }
    
    protected function getMethodNameFor($value)
    {
        $actionName = $this->getActionNameFor($value);
        if($actionName === null) {
            return null;
        }
        
        $methodName = $this->actionMethodName($actionName);
        
        if(!method_exists($this, $methodName)) {
            return null;
        }
        
        return $methodName;
    }
    
    protected function actionMethodName($actionName)
    {
        return $actionName.'Action';
    }
    
    abstract protected function getActionNameFor($value);
}
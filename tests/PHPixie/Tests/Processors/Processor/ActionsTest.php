<?php

namespace PHPixie\Tests\Processors\Processor;

/**
 * @coversDefaultClass \PHPixie\Processors\Processor\Actions
 */
class ActionsTest extends \PHPixie\Test\Testcase
{
    /**
     * @covers ::isProcessable
     * @covers ::process
     * @covers ::<protected>
     */
    public function testActions()
    {
        $this->actionsTest(false);
        $this->actionsTest(true);
        $this->actionsTest(true, true);
    }
    
    protected function actionsTest($actionExists = false, $methodExists = false)
    {
        $method = $this->prepareActionMethodName('pixie');

        $processorMock = $this->processorMock(array(
            'getActionNameFor',
            $method
        ));
        
        $value = $this->getValue();
        
        if($actionExists) {
            $actionName = $methodExists ? 'pixie' : 'trixieNotExisting';
            
        }else{
            $actionName = null;
        }
        
        $this->method($processorMock, 'getActionNameFor', $actionName, array($value));
        
        if($methodExists) {
            $result = new \stdClass();
            
            $this->method($processorMock, $method, $result, array($value));
            $this->assertSame(true, $processorMock->isProcessable($value));
            $this->assertSame($result, $processorMock->process($value));
            
        }else{
            $this->assertSame(false, $processorMock->isProcessable($value));
            $this->assertException(function () use($processorMock, $value) {
                $processorMock->process($value);
            }, '\PHPixie\Processors\Exception');
        }
    }
    
    protected function prepareActionMethodName($actionName)
    {
        return $actionName.'Action';
    }
    
    protected function getValue()
    {
        return new \stdClass();
    }
    
    protected function processorMock($methods = array())
    {
        return $this->quickMock('\PHPixie\Processors\Processor\Actions', $methods);
    }
}
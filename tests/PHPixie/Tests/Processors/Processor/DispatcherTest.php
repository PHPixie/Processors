<?php

namespace PHPixie\Tests\Processors\Processor;

/**
 * @coversDefaultClass \PHPixie\Processors\Processor\Dispatcher
 */
class DispatcherTest extends \PHPixie\Test\Testcase
{
    protected $dispatcherMock;
    
    /**
     * @covers ::process
     * @covers ::isProcessable
     * @covers ::<protected>
     */
    public function testIsProcessable()
    {
        $this->dispatchTest(false, false);
        
        $this->dispatchTest(true, true, true);
        $this->dispatchTest(false, true, false);
        
        $this->dispatchTest(false, true, true, true);
        $this->dispatchTest(true, true, true, true, true);
    }
    
    protected function dispatchTest(
        $expectExists  = false,
        $nameExists    = false,
        $exists        = false,
        $isSelective   = false,
        $isProcessable = false
    )
    {
        $this->dispatcherMock = $this->dispatcherMock(array(
            'getProcessorNameFor',
            'processor'
        ));
        
        $value = $this->getValue();
        
        $processor = $this->prepareGetProcessorFor(
            $value,
            $nameExists,
            $exists,
            $isSelective,
            $isProcessable
        );
        
        if($expectExists) {
            $response = new \stdClass();
            $this->method($processor, 'process', $response, array($value));
            $this->assertSame($response, $this->dispatcherMock->process($value));
            
        }else{
            $dispatcherMock = $this->dispatcherMock;
            $this->assertException(function() use($dispatcherMock, $value) {
                $dispatcherMock->process($value);
            }, '\PHPixie\Processors\Exception');
        }
        
        $this->assertSame($expectExists, $this->dispatcherMock->isProcessable($value));
    }
    
    protected function prepareGetProcessorFor($value, $nameExists, $exists, $isSelective, $isProcessable)
    {
        $name = $nameExists ? 'pixie' : null;
        $this->method($this->dispatcherMock, 'getProcessorNameFor', $name, array($value));
        
        if(!$nameExists) {
            return null;
        }
        
        if(!$exists) {
            $processor = null;
        
        }elseif(!$isSelective) {
            $processor = $this->quickMock('\PHPixie\Processors\Processor');
            
        }else{
            $processor = $this->quickMock('\PHPixie\Processors\Processor\Selective');
            $this->method($processor, 'isProcessable', $isProcessable, array($value));
        }
        
        $this->method($this->dispatcherMock, 'processor', $processor, array($name));
        
        if($isSelective && !$isProcessable) {
            return null;
        }
        
        return $processor;
    }
    
    protected function getValue()
    {
        return new \stdClass();
    }
    
    protected function dispatcherMock($methods = array())
    {
        return $this->quickMock('\PHPixie\Processors\Processor\Dispatcher', $methods);
    }
}
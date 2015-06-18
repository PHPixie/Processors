<?php

namespace PHPixie\Tests\Processors\Processor;

/**
 * @coversDefaultClass \PHPixie\Processors\Processor\Dispatch
 */
class DispatchTest extends \PHPixie\Test\Testcase
{
    protected $dispatcher;
    
    protected $dispatch;
    
    public function setUp()
    {
        $this->dispatcher = $this->quickMock('\PHPixie\Processors\Dispatcher');
        
        $this->dispatch = new \PHPixie\Processors\Processor\Dispatch(
            $this->dispatcher
        );
    }
    
    /**
     * @covers ::__construct
     */
    public function testConstruct()
    {
    
    }
    
    /**
     * @covers ::process
     */
    public function testProcess()
    {
        $input  = new \stdClass();
        $output = new \stdClass();
        $processor = $this->quickMock('\PHPixie\Processors\Processor');
        
        $this->method($this->dispatcher, 'getProcessorFor', $processor, array($input), 0);
        $this->method($processor, 'process', $output, array($input), 0);
        
        $this->assertSame($output, $this->dispatch->process($input));
    }
}
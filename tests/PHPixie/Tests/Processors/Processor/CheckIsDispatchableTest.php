<?php

namespace PHPixie\Tests\Processors\Processor;

/**
 * @coversDefaultClass \PHPixie\Processors\Processor\CheckIsDispatchable
 */
class CheckIsDispatchableTest extends \PHPixie\Test\Testcase
{
    protected $dispatcher;
    protected $foundProcessor;
    protected $notFoundProcessor;
    
    protected $checkRoute;
    
    public function setUp()
    {
        $this->dispatcher        = $this->quickMock('\PHPixie\Processors\Dispatcher');
        $this->foundProcessor    = $this->quickMock('\PHPixie\Processors\Processor');
        $this->notFoundProcessor = $this->quickMock('\PHPixie\Processors\Processor');
        
        $this->checkRoute = new \PHPixie\Processors\Processor\CheckIsDispatchable(
            $this->dispatcher,
            $this->foundProcessor,
            $this->notFoundProcessor
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
        $this->processTest(false);
        $this->processTest(true);
    }
    
    protected function processTest($found)
    {
        $request = $this->quickMock('\PHPixie\HTTP\Request');
        $this->method($this->dispatcher, 'hasProcessorFor', $found, array($request), 0);
        
        $processor = $found ? $this->foundProcessor : $this->notFoundProcessor;
        $response = $this->quickMock('\PHPixie\HTTP\Response');
        
        $this->method($processor, 'process', $response, array($request), 0);
        
        $this->assertSame($response, $this->checkRoute->process($request));
    }
}
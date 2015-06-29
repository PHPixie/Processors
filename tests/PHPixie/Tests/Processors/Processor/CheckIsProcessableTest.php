<?php

namespace PHPixie\Tests\Processors\Processor;

/**
 * @coversDefaultClass \PHPixie\Processors\Processor\CheckIsProcessable
 */
class CheckIsProcessableTest extends \PHPixie\Test\Testcase
{
    protected $processor;
    protected $processableProcessor;
    protected $notProcessableProcessor;
    
    protected $checkIsProcessable;
    
    public function setUp()
    {
        $this->processor               = $this->quickMock('\PHPixie\Processors\Dispatcher');
        $this->processableProcessor    = $this->quickMock('\PHPixie\Processors\Processor');
        $this->notProcessableProcessor = $this->quickMock('\PHPixie\Processors\Processor');
        
        $this->checkIsProcessable = $this->checkIsProcessable();
    }
    
    /**
     * @covers ::__construct
     */
    public function testConstruct()
    {
    
    }
    
    /**
     * @covers ::process
     * @covers ::<protected>
     */
    public function testProcess()
    {
        $this->processTest(false);
        $this->processTest(true, false);
        $this->processTest(true, true);
    }
    
    protected function processTest($isSelective = false, $isProcessable = false)
    {
        $input = new \stdClass;
        
        if($isSelective) {
            $this->processor = $this->quickMock('\PHPixie\Processors\Processor\Selective');
            $this->method($this->processor, 'isProcessable', $isProcessable, array($input), 0);
            $processor = $isProcessable ? $this->processableProcessor : $this->notProcessableProcessor;
        }else{
            $this->processor = $this->quickMock('\PHPixie\Processors\Processor');
            $processor = $this->processableProcessor;
        }
        
        $this->checkIsProcessable = $this->checkIsProcessable();
        
        $output = new \stdClass;
        $this->method($processor, 'process', $output, array($input), 0);
        
        $this->assertSame($output, $this->checkIsProcessable->process($input));
    }
    
    protected function checkIsProcessable()
    {
        return new \PHPixie\Processors\Processor\CheckIsProcessable(
            $this->processor,
            $this->processableProcessor,
            $this->notProcessableProcessor
        );
    }
}
<?php

namespace PHPixie\Tests\Processors\Processor;

/**
 * @coversDefaultClass \PHPixie\Processors\Processor\CatchException
 */
class CatchExceptionTest extends \PHPixie\Test\Testcase
{
    protected $valueProcessor;
    protected $exceptionProcessor;
    
    protected $catchException;
    
    public function setUp()
    {
        $this->valueProcessor     = $this->quickMock('\PHPixie\Processors\Processor');
        $this->exceptionProcessor = $this->quickMock('\PHPixie\Processors\Processor');
        
        $this->catchException = new \PHPixie\Processors\Processor\CatchException(
            $this->valueProcessor,
            $this->exceptionProcessor
        );
    }

    /**
     * @covers ::__construct
     * @covers ::<protected>
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
    
    protected function processTest($exceptionRaised)
    {
        $input  = new \stdClass;
        $output = new \stdClass;
        
        if($exceptionRaised) {
            $exception = new \Exception;
            $this->method($this->valueProcessor, 'process', function() use($exception){
                throw $exception;
            });
            
            $this->method($this->exceptionProcessor, 'process', $output, array($exception), 0);    
        }else{
            $this->method($this->valueProcessor, 'process', $output, array($input), 0);    
        }
        
        $this->assertSame($output, $this->catchException->process($input));
    }
}
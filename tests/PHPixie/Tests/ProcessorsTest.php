<?php

namespace PHPixie\Tests;

/**
 * @coversDefaultClass \PHPixie\Processors
 */
class ProcessorsTest extends \PHPixie\Test\Testcase
{
    protected $processors;
    
    public function setUp()
    {
        $this->processors = new \PHPixie\Processors();
    }
    
    /**
     * @covers ::chain
     * @covers ::<protected>
     */
    public function testChain()
    {
        $processors = array(
            $this->getProcessor()
        );
        $chain = $this->processors->chain($processors);
        $this->assertInstance($chain, '\PHPixie\Processors\Processor\Chain', array(
            'processors' => $processors
        ));
    }
    
    /**
     * @covers ::checkIsProcessable
     * @covers ::<protected>
     */
    public function testCheckIsProcessable()
    {
        $processor               = $this->getProcessor();
        $processableProcessor    = $this->getProcessor();
        $notProcessableProcessor = $this->getProcessor();
        
        $checkIsProcessable = $this->processors->checkIsProcessable(
            $processor,
            $processableProcessor,
            $notProcessableProcessor
        );
        
        $this->assertInstance($checkIsProcessable, '\PHPixie\Processors\Processor\CheckIsProcessable', array(
            'processor'               => $processor,
            'processableProcessor'    => $processableProcessor,
            'notProcessableProcessor' => $notProcessableProcessor,
        ));
    }
    
    /**
     * @covers ::catchException
     * @covers ::<protected>
     */
    public function testCatchException()
    {
        $valueProcessor     = $this->getProcessor();
        $exceptionProcessor = $this->getProcessor();
        
        $processor = $this->processors->catchException(
            $valueProcessor,
            $exceptionProcessor
        );
        
        $this->assertInstance($processor, '\PHPixie\Processors\Processor\CatchException', array(
            'valueProcessor'     => $valueProcessor,
            'exceptionProcessor' => $exceptionProcessor,
        ));
    }
    
    protected function getProcessor()
    {
        return $this->quickMock('\PHPixie\Processors\Processor');
    }
}
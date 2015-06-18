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
            $this->quickMock('\PHPixie\Processors\Processor')
        );
        $chain = $this->processors->chain($processors);
        $this->assertInstance($chain, '\PHPixie\Processors\Processor\Chain', array(
            'processors' => $processors
        ));
    }
    
    /**
     * @covers ::dispatch
     * @covers ::<protected>
     */
    public function testDispatch()
    {
        $dispatcher = $this->quickMock('\PHPixie\Processors\Dispatcher');
        $dispatch = $this->processors->dispatch($dispatcher);
        $this->assertInstance($dispatch, '\PHPixie\Processors\Processor\Dispatch', array(
            'dispatcher' => $dispatcher
        ));
    }
    
    /**
     * @covers ::checkIsDispatchable
     * @covers ::<protected>
     */
    public function testCheckIsDispatchable()
    {
        $dispatcher        = $this->quickMock('\PHPixie\Processors\Dispatcher');
        $foundProcessor    = $this->quickMock('\PHPixie\Processors\Processor');
        $notFoundProcessor = $this->quickMock('\PHPixie\Processors\Processor');
        
        $processor = $this->processors->checkIsDispatchable(
            $dispatcher,
            $foundProcessor,
            $notFoundProcessor
        );
        
        $this->assertInstance($processor, '\PHPixie\Processors\Processor\CheckIsDispatchable', array(
            'dispatcher'        => $dispatcher,
            'foundProcessor'    => $foundProcessor,
            'notFoundProcessor' => $notFoundProcessor,
        ));
    }
}
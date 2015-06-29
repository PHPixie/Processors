<?php

namespace PHPixie\Tests\Processors\Processor\Dispatcher;

/**
 * @coversDefaultClass \PHPixie\Processors\Processor\Dispatcher\Registry
 */
class RegistryTest extends \PHPixie\Tests\Processors\Processor\DispatcherTest
{
    protected $registry;
    
    public function setUp()
    {
        $this->registry = $this->quickMock('\PHPixie\Processors\Registry');
    }
    
    /**
     * @covers ::processor
     * @covers ::<protected>
     */
    public function testProcessor()
    {
        $dispatcherMock = $this->dispatcherMock(array('getProcessorNameFor'));
        $processor = $this->getProcessor();
        
        $this->method($this->registry, 'get', $processor, array('pixie'), 0);
        $this->assertSame($processor, $dispatcherMock->processor('pixie'));
    }
    
    protected function dispatcherMock($methods = array())
    {
        return $this->getMock(
            '\PHPixie\Processors\Processor\Dispatcher\Registry',
            $methods,
            array($this->registry)
        );
    }
}
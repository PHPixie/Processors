<?php

namespace PHPixie\Tests\Processors\Processor\Dispatcher;

/**
 * @coversDefaultClass \PHPixie\Processors\Processor\Dispatcher\Builder
 */
class BuilderTest extends \PHPixie\Tests\Processors\Processor\DispatcherTest
{
    /**
     * @covers ::processor
     * @covers ::<protected>
     */
    public function testProcessor()
    {
        $dispatcherMock = $this->dispatcherMock(array(
            'getProcessorNameFor',
            'buildPixieProcessor'
        ));
        
        $this->assertSame(null, $dispatcherMock->processor('trixie'));
        
        $processor = $this->getProcessor();
        $this->method($dispatcherMock, 'buildPixieProcessor', $processor, array(), 0);
        
        for($i=0; $i<2; $i++) {
            $this->assertSame($processor, $dispatcherMock->processor('pixie'));
        }
    }
    
    protected function dispatcherMock($methods = array())
    {
        return $this->quickMock(
            '\PHPixie\Processors\Processor\Dispatcher\Builder',
            $methods
        );
    }
}
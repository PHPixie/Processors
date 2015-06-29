<?php

namespace PHPixie\Tests\Processors\Processor;

/**
 * @coversDefaultClass \PHPixie\Processors\Processor\Chain
 */
class ChainTest extends \PHPixie\Test\Testcase
{
    protected $processors = array();
    protected $stack;
    
    public function setUp()
    {
        for($i = 0; $i < 4; $i++) {
            $this->processors[]= $this->quickMock('\PHPixie\Processors\Processor');
        }
        
        $this->chain = new \PHPixie\Processors\Processor\Chain($this->processors);
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
     * @covers ::<protected>
     */
    public function testProcess()
    {
        $value = 'test';
        
        foreach($this->processors as $key => $processor) {
            $this->method($processor, 'process', $key, array($value), 0);
            $value = $key;
        }
        
        $this->assertSame($value, $this->chain->process('test'));
    }
    
}
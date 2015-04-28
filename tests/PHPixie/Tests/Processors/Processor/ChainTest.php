<?php

namespace PHPixie\Tests\Processors\Processor;

/**
 * @coversDefaultClass \PHPixie\Processors\Processor\Chain
 */
class ChainTest extends \PHPixie\Test\Testcase
{
    protected $registries;
    protected $chain;
    
    public function setUp()
    {
        $this->registries = $this->quickMock('\PHPixie\Processors\Registries');
        $this->chain = new \PHPixie\Processors\Processor\Chain($this->registries);
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
        $sets = array(
            array('pixie', 'trixie'),
            array('stella', 'blum')
        );
        
        $configs = array();
        $value = 'fairy';
        foreach($sets as $key => $set) {
            $slice = $this->getSliceData();
            $configs[]= $slice;
            
            $this->method($slice, 'getRequired', $set[0], array('processor'), 0);
            
            $processorConfig = $this->getSliceData();
            $this->method($slice, 'slice', $processorConfig, array('config'), 1);
            
            $processor = $this->getProcessor();
            $this->method($this->registries, 'processor', $processor, array($set[0]), $key);
            
            $this->method($processor, 'process', $set[1], array($processorConfig, $value), 0);
            $value = $set[1];
        }
        
        $this->assertSame($value, $this->chain->process($configs, 'fairy'));
    }
    
    /**
     * @covers ::name
     * @covers ::<protected>
     */
    public function testName()
    {
        $this->assertSame('chain', $this->chain->name());
    }
    
    protected function getProcessor()
    {
        return $this->quickMock('\PHPixie\Processors\Processor');
    }
    
    protected function getSliceData()
    {
        return $this->quickMock('\PHPixie\Slice\Data');
    }
}
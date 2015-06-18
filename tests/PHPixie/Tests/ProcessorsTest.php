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
}
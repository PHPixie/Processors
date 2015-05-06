<?php

namespace PHPixie\Tests\Processors\Repository;

/**
 * @coversDefaultClass \PHPixie\Processors\Repository\Composite
 */
class CompositeTest extends \PHPixie\Test\Testcase
{
    protected $repositoryMap = array();
    protected $composite;
    
    public function setUp()
    {
        foreach(array('pixie', 'trixie') as $name) {
            $this->repositoryMap[$name] = $this->quickMock('\PHPixie\Processors\Repository\Composite');
        }
        
        $this->composite = new \PHPixie\Processors\Repository\Composite($this->repositoryMap);
    }
    
    /**
     * @covers ::__construct
     * @covers ::<protected>
     */
    public function testConstruct()
    {
    
    }
    
    /**
     * @covers ::repository
     * @covers ::<protected>
     */
    public function testRepository()
    {
        foreach($this->repositoryMap as $name => $repository) {
            $this->assertSame($repository, $this->composite->repository($name));
        }
        
        $composite = $this->composite;
        $this->assertException(function() use($composite) {
            $composite->repository('fairy');
        }, '\PHPixie\Processors\Exception');
    }
    
    /**
     * @covers ::get
     * @covers ::<protected>
     */
    public function testGet()
    {
        $processor = $this->quickMock('\PHPixie\Processors\Processor');
        $this->method($this->repositoryMap['pixie'], 'get', $processor, array('fairy'), 0);
        $this->assertSame($processor, $this->composite->get('pixie.fairy'));
        
        $composite = $this->composite;
        $this->assertException(function() use($composite) {
            $composite->get('fairy');
        }, '\PHPixie\Processors\Exception');
    }
    
    /**
     * @covers ::get
     * @covers ::<protected>
     */
    public function testGetDefault()
    {
        $this->composite = new \PHPixie\Processors\Repository\Composite($this->repositoryMap, 'pixie');
        $processor = $this->quickMock('\PHPixie\Processors\Processor');
        $this->method($this->repositoryMap['pixie'], 'get', $processor, array('fairy'), 0);
        $this->assertSame($processor, $this->composite->get('fairy'));
        
        $composite = $this->composite;
        $this->assertException(function() use($composite) {
            $composite->get('blum.fairy');
        }, '\PHPixie\Processors\Exception');
    }
}
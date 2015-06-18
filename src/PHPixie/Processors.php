<?php

namespace PHPixie;

class Processors
{
    public function chain($processors)
    {
        return new Processors\Processor\Chain($processors);
    }
}
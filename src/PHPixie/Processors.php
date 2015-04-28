<?php

namespace PHPixie;

class Processors
{
    public function get($name)
    {
        return $this->builder->registries()->getProcessor($name);
    }
    
}
<?php

namespace PHPixie\Processors;

class Builder
{
    public function defaultRegistry()
    {
        return new Registries\Registry\Default(
            $this->registries()
        );
    }
    
    
}
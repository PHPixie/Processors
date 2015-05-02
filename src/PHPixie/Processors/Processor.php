<?php

namespace PHPixie\Processors;

interface Processor
{
    public function process($input);
    public function name();
}
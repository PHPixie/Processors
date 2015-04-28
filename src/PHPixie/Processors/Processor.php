<?php

namespace PHPixie\Processors;

interface Processor
{
    public function process($configData, $input);
    public function name();
}
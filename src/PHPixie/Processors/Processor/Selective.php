<?php

namespace PHPixie\Processors\Processor;

interface Selective extends \PHPixie\Processors\Processor
{
    public function isProcessable($value);
}
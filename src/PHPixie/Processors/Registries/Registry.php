<?php

namespace PHPixie\Process\Processors;

interface Registry
{
    public function get($name);
    public function processorNames();
}
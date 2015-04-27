<?php

namespace PHPixie\Process;

interface Processors
{
    public function get($name);
    public function processorNames();
}
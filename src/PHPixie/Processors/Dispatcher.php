<?php

namespace PHPixie\Processors;

interface Dispatcher
{
    public function hasProcessorFor($value);
    public function getProcessorFor($value);
}
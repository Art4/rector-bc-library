<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorParamType\AddParamStringTypeFromSprintfUseRector\Fixture;

class SomeClass
{
    public function formatMessage($name)
    {
        return sprintf('My name is %s', $name);
    }
}
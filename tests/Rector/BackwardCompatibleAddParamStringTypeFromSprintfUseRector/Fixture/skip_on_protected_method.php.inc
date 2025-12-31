<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleAddParamStringTypeFromSprintfUseRector\Fixture;

class SomeClass
{
    protected function formatMessage($name)
    {
        return sprintf('My name is %s', $name);
    }
}

<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnTypeFromStrictParamRector\Fixture;

class SomeClass
{
    protected function resolve(\stdClass $item)
    {
        return $item;
    }
}
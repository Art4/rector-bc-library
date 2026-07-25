<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnTypeFromStrictParamRector\Fixture;

class SomeClass
{
    public function resolve(\stdClass $item)
    {
        return $item;
    }
}
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictParamRector\Fixture;

class SomeClass
{
    protected function resolve(\stdClass $item)
    {
        return $item;
    }
}

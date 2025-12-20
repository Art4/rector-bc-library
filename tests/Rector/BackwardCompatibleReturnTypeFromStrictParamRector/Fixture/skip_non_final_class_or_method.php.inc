<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictParamRector\Fixture;

class SomeClass
{
    public function resolve(\stdClass $item)
    {
        return $item;
    }
}

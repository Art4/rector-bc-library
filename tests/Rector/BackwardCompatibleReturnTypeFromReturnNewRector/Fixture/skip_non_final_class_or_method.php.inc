<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromReturnNewRector\Fixture;

class SomeClass
{
    public function create()
    {
        return new \stdClass();
    }
}

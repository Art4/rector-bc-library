<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnNeverTypeRector\Fixture;

class SomeClass
{
    protected function run()
    {
        throw new InvalidException();
    }
}
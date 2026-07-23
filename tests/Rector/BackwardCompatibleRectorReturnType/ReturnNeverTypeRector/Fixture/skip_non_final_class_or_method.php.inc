<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnNeverTypeRector\Fixture;

class SomeClass
{
    public function run()
    {
        throw new InvalidException();
    }
}
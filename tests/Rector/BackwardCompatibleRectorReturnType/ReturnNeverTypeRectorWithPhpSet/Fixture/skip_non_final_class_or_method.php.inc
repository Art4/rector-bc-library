<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnNeverTypeRectorWithPhpSet\Fixture;

class SomeClass
{
    public function run()
    {
        throw new InvalidException();
    }
}

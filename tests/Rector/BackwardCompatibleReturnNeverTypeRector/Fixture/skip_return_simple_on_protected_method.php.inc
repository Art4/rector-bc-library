<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnNeverTypeRector\Fixture;

class SomeClass
{
    protected function run()
    {
        throw new InvalidException();
    }
}

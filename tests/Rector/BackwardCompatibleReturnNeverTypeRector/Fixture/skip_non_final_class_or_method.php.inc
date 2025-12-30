<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnNeverTypeRector\Fixture;

class SomeClass
{
    public function run()
    {
        throw new InvalidException();
    }
}

<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnNeverTypeRectorTargetPhp74\Fixture;

final class SomeClass
{
    public function run()
    {
        throw new InvalidException();
    }
}

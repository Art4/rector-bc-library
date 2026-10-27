<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnNeverTypeRectorWithPhpSet\Fixture;

trait SomeTrait
{
    public function run()
    {
        throw new InvalidException();
    }
}

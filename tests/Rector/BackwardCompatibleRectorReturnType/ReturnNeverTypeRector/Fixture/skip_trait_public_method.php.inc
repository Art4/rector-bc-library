<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnNeverTypeRector\Fixture;

trait SomeTrait
{
    public function run()
    {
        throw new InvalidException();
    }
}

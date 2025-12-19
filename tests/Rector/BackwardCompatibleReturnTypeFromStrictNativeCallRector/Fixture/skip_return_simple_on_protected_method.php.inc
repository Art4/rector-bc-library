<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictNativeCallRector\Fixture;

class SomeClass
{
    protected function run()
    {
        return strlen('value');
    }
}

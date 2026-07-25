<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnTypeFromStrictNativeCallRector\Fixture;

class SomeClass
{
    protected function run()
    {
        return strlen('value');
    }
}
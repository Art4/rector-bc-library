<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnTypeFromStrictNativeCallRector\Fixture;

class SomeClass
{
    public function run()
    {
        return strlen('value');
    }
}
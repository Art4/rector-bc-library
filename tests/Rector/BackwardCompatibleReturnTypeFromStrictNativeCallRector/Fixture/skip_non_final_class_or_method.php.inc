<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictNativeCallRector\Fixture;

class SomeClass
{
    public function run()
    {
        return strlen('value');
    }
}

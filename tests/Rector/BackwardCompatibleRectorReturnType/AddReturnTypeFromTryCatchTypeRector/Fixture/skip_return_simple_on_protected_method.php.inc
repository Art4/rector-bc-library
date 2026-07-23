<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\AddReturnTypeFromTryCatchTypeRector\Fixture;

class SomeClass
{
    protected function run()
    {
        try {
            return 1;
        } catch (\Exception $e) {
            return 2;
        }
    }
}
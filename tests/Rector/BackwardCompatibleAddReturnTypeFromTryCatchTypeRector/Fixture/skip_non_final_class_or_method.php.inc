<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleAddReturnTypeFromTryCatchTypeRector\Fixture;

class SomeClass
{
    public function run()
    {
        try {
            return 1;
        } catch (\Exception $e) {
            return 2;
        }
    }
}

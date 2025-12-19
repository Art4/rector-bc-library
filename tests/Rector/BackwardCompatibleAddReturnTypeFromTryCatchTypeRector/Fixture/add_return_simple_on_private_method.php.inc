<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleAddReturnTypeFromTryCatchTypeRector\Fixture;

class SomeClass
{
    private function run()
    {
        try {
            return 1;
        } catch (\Exception $e) {
            return 2;
        }
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleAddReturnTypeFromTryCatchTypeRector\Fixture;

class SomeClass
{
    private function run(): int
    {
        try {
            return 1;
        } catch (\Exception $e) {
            return 2;
        }
    }
}

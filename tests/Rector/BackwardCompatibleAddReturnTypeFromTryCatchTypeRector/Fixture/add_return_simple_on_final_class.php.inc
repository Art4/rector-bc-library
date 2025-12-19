<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleAddReturnTypeFromTryCatchTypeRector\Fixture;

final class SomeClass
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
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleAddReturnTypeFromTryCatchTypeRector\Fixture;

final class SomeClass
{
    public function run(): int
    {
        try {
            return 1;
        } catch (\Exception $e) {
            return 2;
        }
    }
}

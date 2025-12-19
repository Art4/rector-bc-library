<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictNativeCallRector\Fixture;

class SomeClass
{
    private function run()
    {
        return strlen('value');
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictNativeCallRector\Fixture;

class SomeClass
{
    private function run(): int
    {
        return strlen('value');
    }
}

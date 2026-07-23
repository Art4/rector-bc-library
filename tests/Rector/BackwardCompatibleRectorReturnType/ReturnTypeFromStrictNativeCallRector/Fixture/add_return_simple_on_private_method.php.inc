<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnTypeFromStrictNativeCallRector\Fixture;

class SomeClass
{
    private function run()
    {
        return strlen('value');
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnTypeFromStrictNativeCallRector\Fixture;

class SomeClass
{
    private function run(): int
    {
        return strlen('value');
    }
}
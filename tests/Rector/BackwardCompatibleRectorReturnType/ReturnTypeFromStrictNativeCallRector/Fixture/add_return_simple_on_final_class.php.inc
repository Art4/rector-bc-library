<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnTypeFromStrictNativeCallRector\Fixture;

final class SomeClass
{
    public function run()
    {
        return strlen('value');
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnTypeFromStrictNativeCallRector\Fixture;

final class SomeClass
{
    public function run(): int
    {
        return strlen('value');
    }
}
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnTypeFromStrictNativeCallRector\Fixture;

class SomeClass
{
    final public function run()
    {
        return strlen('value');
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnTypeFromStrictNativeCallRector\Fixture;

class SomeClass
{
    final public function run(): int
    {
        return strlen('value');
    }
}
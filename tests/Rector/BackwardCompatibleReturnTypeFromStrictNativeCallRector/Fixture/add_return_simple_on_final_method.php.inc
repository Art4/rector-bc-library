<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictNativeCallRector\Fixture;

class SomeClass
{
    final public function run()
    {
        return strlen('value');
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictNativeCallRector\Fixture;

class SomeClass
{
    final public function run(): int
    {
        return strlen('value');
    }
}

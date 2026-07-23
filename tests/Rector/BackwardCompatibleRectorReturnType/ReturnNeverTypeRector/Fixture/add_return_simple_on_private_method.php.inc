<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnNeverTypeRector\Fixture;

class SomeClass
{
    private function run()
    {
        throw new InvalidException();
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnNeverTypeRector\Fixture;

class SomeClass
{
    private function run(): never
    {
        throw new InvalidException();
    }
}
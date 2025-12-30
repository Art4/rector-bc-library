<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnNeverTypeRector\Fixture;

class SomeClass
{
    private function run()
    {
        throw new InvalidException();
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnNeverTypeRector\Fixture;

class SomeClass
{
    private function run(): never
    {
        throw new InvalidException();
    }
}

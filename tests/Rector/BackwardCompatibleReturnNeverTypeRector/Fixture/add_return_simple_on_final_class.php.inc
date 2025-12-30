<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnNeverTypeRector\Fixture;

final class SomeClass
{
    public function run()
    {
        throw new InvalidException();
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnNeverTypeRector\Fixture;

final class SomeClass
{
    public function run(): never
    {
        throw new InvalidException();
    }
}

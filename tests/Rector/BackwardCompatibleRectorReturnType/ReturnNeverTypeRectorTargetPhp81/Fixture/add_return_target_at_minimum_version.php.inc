<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnNeverTypeRectorTargetPhp81\Fixture;

final class SomeClass
{
    public function run()
    {
        throw new InvalidException();
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnNeverTypeRectorTargetPhp81\Fixture;

final class SomeClass
{
    public function run(): never
    {
        throw new InvalidException();
    }
}

<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictTernaryRector\Fixture;

final class SomeClass
{
    public function getValue($number)
    {
        return $number ? 100 : 500;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictTernaryRector\Fixture;

final class SomeClass
{
    public function getValue($number): int
    {
        return $number ? 100 : 500;
    }
}

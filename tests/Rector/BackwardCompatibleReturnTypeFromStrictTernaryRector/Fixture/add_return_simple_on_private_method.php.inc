<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictTernaryRector\Fixture;

class SomeClass
{
    private function getValue($number)
    {
        return $number ? 100 : 500;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictTernaryRector\Fixture;

class SomeClass
{
    private function getValue($number): int
    {
        return $number ? 100 : 500;
    }
}

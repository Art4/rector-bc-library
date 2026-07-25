<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\BoolReturnTypeFromBooleanStrictReturnsRector\Fixture;

class SomeClass
{
    private function isGreater($first, $second)
    {
        return $first > $second;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\BoolReturnTypeFromBooleanStrictReturnsRector\Fixture;

class SomeClass
{
    private function isGreater($first, $second): bool
    {
        return $first > $second;
    }
}
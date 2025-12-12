<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleBoolReturnTypeFromBooleanStrictReturnsRector\Fixture;

final class SimpleStrictBoolReturn
{
    public function isGreater($first, $second)
    {
        return $first > $second;
    }
}

?>
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleBoolReturnTypeFromBooleanStrictReturnsRector\Fixture;

final class SimpleStrictBoolReturn
{
    public function isGreater($first, $second): bool
    {
        return $first > $second;
    }
}

?>

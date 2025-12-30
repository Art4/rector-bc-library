<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleBoolReturnTypeFromBooleanConstReturnsRector\Fixture;

final class SomeClass
{
    public function isActive()
    {
        return true;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleBoolReturnTypeFromBooleanConstReturnsRector\Fixture;

final class SomeClass
{
    public function isActive(): bool
    {
        return true;
    }
}

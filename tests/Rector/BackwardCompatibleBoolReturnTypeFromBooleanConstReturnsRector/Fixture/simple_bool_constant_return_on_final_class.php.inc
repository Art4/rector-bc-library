<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleBoolReturnTypeFromBooleanConstReturnsRector\Fixture;

final class SimpleBoolConstantReturn
{
    public function isActive()
    {
        return true;
    }
}

?>
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleBoolReturnTypeFromBooleanConstReturnsRector\Fixture;

final class SimpleBoolConstantReturn
{
    public function isActive(): bool
    {
        return true;
    }
}

?>

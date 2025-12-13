<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleBoolReturnTypeFromBooleanConstReturnsRector\Fixture;

class SimpleBoolConstantReturn
{
    final public function isActive()
    {
        return true;
    }
}

?>
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleBoolReturnTypeFromBooleanConstReturnsRector\Fixture;

class SimpleBoolConstantReturn
{
    final public function isActive(): bool
    {
        return true;
    }
}

?>

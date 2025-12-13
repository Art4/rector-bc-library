<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleBoolReturnTypeFromBooleanConstReturnsRector\Fixture;

final class MultipleBooleanReturns
{
    public function checkStatus()
    {
        if ($this->enabled) {
            return true;
        }
        return false;
    }
}

?>
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleBoolReturnTypeFromBooleanConstReturnsRector\Fixture;

final class MultipleBooleanReturns
{
    public function checkStatus(): bool
    {
        if ($this->enabled) {
            return true;
        }
        return false;
    }
}

?>

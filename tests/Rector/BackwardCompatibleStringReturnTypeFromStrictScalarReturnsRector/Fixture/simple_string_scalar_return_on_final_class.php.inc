<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleStringReturnTypeFromStrictScalarReturnsRector\Fixture;

final class SimpleStringScalarReturn
{
    public function foo()
    {
        if (true) {
            return 'yes';
        }

        return 'no';
    }
}

?>
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleStringReturnTypeFromStrictScalarReturnsRector\Fixture;

final class SimpleStringScalarReturn
{
    public function foo(): string
    {
        if (true) {
            return 'yes';
        }

        return 'no';
    }
}

?>

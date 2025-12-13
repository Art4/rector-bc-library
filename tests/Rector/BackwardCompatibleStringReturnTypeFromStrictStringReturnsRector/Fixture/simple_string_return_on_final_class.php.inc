<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleStringReturnTypeFromStrictStringReturnsRector\Fixture;

final class SimpleStringReturn
{
    public function foo($value)
    {
        if ($value) {
            return 'yes';
        }

        return strtoupper($value);
    }
}

?>
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleStringReturnTypeFromStrictStringReturnsRector\Fixture;

final class SimpleStringReturn
{
    public function foo($value): string
    {
        if ($value) {
            return 'yes';
        }

        return strtoupper($value);
    }
}

?>

<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleStringReturnTypeFromStrictScalarReturnsRector\Fixture;

final class SomeClass
{
    public function foo()
    {
        if (true) {
            return 'yes';
        }

        return 'no';
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleStringReturnTypeFromStrictScalarReturnsRector\Fixture;

final class SomeClass
{
    public function foo(): string
    {
        if (true) {
            return 'yes';
        }

        return 'no';
    }
}

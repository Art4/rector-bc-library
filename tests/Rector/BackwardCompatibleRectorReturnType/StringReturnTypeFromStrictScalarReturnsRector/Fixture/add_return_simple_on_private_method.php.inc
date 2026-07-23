<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\StringReturnTypeFromStrictScalarReturnsRector\Fixture;

class SomeClass
{
    private function foo()
    {
        if (true) {
            return 'yes';
        }

        return 'no';
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\StringReturnTypeFromStrictScalarReturnsRector\Fixture;

class SomeClass
{
    private function foo(): string
    {
        if (true) {
            return 'yes';
        }

        return 'no';
    }
}
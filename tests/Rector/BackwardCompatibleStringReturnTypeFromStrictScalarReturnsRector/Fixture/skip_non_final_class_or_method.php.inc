<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleStringReturnTypeFromStrictScalarReturnsRector\Fixture;

class SkipNonFinalClass
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

class SkipNonFinalClass
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

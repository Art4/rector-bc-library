<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromReturnNewRector\Fixture;

final class SimpleReturnNewOnFinalMethod
{
    public final function create()
    {
        return new \stdClass();
    }
}

?>
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromReturnNewRector\Fixture;

final class SimpleReturnNewOnFinalMethod
{
    public final function create(): \stdClass
    {
        return new \stdClass();
    }
}

?>

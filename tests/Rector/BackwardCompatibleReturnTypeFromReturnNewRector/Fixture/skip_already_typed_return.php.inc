<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromReturnNewRector\Fixture;

final class SkipAlreadyTypedReturn
{
    public function create(): \stdClass
    {
        return new \stdClass();
    }
}

?>
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromReturnNewRector\Fixture;

final class SkipAlreadyTypedReturn
{
    public function create(): \stdClass
    {
        return new \stdClass();
    }
}

?>

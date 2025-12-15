<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibilityReturnTypeFromReturnNewRector\Fixture;

final class SimpleReturnNew
{
    public function create()
    {
        return new \stdClass();
    }
}

?>
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibilityReturnTypeFromReturnNewRector\Fixture;

final class SimpleReturnNew
{
    public function create(): \stdClass
    {
        return new \stdClass();
    }
}

?>

<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibilityReturnTypeFromReturnNewRector\Fixture;

class SkipNonFinalClass
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

class SkipNonFinalClass
{
    public function create()
    {
        return new \stdClass();
    }
}

?>

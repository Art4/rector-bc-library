<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromReturnNewRector\Fixture;

class SkipNonFinalClassOrMethod
{
    public function create()
    {
        return new \stdClass();
    }
}

?>
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromReturnNewRector\Fixture;

class SkipNonFinalClassOrMethod
{
    public function create()
    {
        return new \stdClass();
    }
}

?>

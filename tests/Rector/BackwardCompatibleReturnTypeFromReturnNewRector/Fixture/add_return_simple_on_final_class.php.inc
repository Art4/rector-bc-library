<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromReturnNewRector\Fixture;

final class SomeClass
{
    public function create()
    {
        return new \stdClass();
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromReturnNewRector\Fixture;

final class SomeClass
{
    public function create(): \stdClass
    {
        return new \stdClass();
    }
}

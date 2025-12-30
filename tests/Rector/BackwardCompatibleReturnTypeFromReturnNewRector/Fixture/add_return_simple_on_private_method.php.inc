<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromReturnNewRector\Fixture;

class SomeClass
{
    private function create()
    {
        return new \stdClass();
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromReturnNewRector\Fixture;

class SomeClass
{
    private function create(): \stdClass
    {
        return new \stdClass();
    }
}

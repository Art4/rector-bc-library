<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnTypeFromReturnNewRector\Fixture;

class SomeClass
{
    private function create()
    {
        return new \stdClass();
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnTypeFromReturnNewRector\Fixture;

class SomeClass
{
    private function create(): \stdClass
    {
        return new \stdClass();
    }
}
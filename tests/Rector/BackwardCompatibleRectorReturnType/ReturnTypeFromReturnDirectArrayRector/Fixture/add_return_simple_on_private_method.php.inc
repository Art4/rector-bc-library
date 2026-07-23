<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnTypeFromReturnDirectArrayRector\Fixture;

class SomeClass
{
    private function getArray()
    {
        return [1, 2, 3];
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnTypeFromReturnDirectArrayRector\Fixture;

class SomeClass
{
    private function getArray(): array
    {
        return [1, 2, 3];
    }
}
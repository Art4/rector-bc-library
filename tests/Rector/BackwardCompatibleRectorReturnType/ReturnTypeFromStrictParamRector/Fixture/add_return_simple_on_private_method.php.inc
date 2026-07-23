<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnTypeFromStrictParamRector\Fixture;

class SomeClass
{
    private function resolve(\stdClass $item)
    {
        return $item;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnTypeFromStrictParamRector\Fixture;

class SomeClass
{
    private function resolve(\stdClass $item): \stdClass
    {
        return $item;
    }
}
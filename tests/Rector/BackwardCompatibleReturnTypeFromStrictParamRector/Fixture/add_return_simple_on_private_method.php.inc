<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictParamRector\Fixture;

class SomeClass
{
    private function resolve(\stdClass $item)
    {
        return $item;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictParamRector\Fixture;

class SomeClass
{
    private function resolve(\stdClass $item): \stdClass
    {
        return $item;
    }
}

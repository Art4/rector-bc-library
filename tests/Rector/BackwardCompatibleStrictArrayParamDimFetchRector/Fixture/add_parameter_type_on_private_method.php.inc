<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleStrictArrayParamDimFetchRector\Fixture;

class SomeClass
{
    private function resolve($item)
    {
        return $item['name'];
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleStrictArrayParamDimFetchRector\Fixture;

class SomeClass
{
    private function resolve(array $item)
    {
        return $item['name'];
    }
}

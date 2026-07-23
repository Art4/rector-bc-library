<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorParamType\StrictArrayParamDimFetchRector\Fixture;

final class SomeClass
{
    public function resolve($item)
    {
        return $item['name'];
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorParamType\StrictArrayParamDimFetchRector\Fixture;

final class SomeClass
{
    public function resolve(array $item)
    {
        return $item['name'];
    }
}
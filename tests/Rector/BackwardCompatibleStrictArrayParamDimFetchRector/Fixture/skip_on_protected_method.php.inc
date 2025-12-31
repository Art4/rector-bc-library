<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleStrictArrayParamDimFetchRector\Fixture;

class SomeClass
{
    protected function resolve($item)
    {
        return $item['name'];
    }
}

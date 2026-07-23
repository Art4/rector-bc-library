<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorParamType\StrictArrayParamDimFetchRector\Fixture;

class SomeClass
{
    public function resolve($item)
    {
        return $item['name'];
    }
}
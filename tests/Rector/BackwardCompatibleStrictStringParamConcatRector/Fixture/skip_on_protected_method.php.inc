<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleStrictStringParamConcatRector\Fixture;

class SomeClass
{
    protected function resolve($item)
    {
        return $item . ' world';
    }
}

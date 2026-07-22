<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleStrictStringParamConcatRector\Fixture;

class SomeClass
{
    public function resolve($item)
    {
        return $item . ' world';
    }
}

<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnTypeFromStrictFluentReturnRector\Fixture;

class SomeClass
{
    public function run()
    {
        return $this;
    }
}
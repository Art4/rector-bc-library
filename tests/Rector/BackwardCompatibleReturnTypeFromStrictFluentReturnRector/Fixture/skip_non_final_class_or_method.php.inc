<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictFluentReturnRector\Fixture;

class SomeClass
{
    public function run()
    {
        return $this;
    }
}

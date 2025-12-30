<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromStrictFluentReturnRector\Fixture;

final class SomeClass
{
    public function run(): mixed
    {
        return $this;
    }
}

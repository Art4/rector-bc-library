<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnTypeFromStrictFluentReturnRector\Fixture;

final class SomeClass
{
    public function run(): mixed
    {
        return $this;
    }
}
<?php

namespace Art4\RectorBcLibrary\Tests\BackwardCompatibleReturnNullableTypeRector;

final class SomeClass
{
    public function getData(): mixed
    {
        if (rand(0, 1)) {
            return null;
        }

        return 100;
    }
}

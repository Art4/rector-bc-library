<?php

namespace Art4\RectorBcLibrary\Tests\BackwardCompatibleReturnNullableTypeRector;

class SomeClass
{
    public function getData()
    {
        if (rand(0, 1)) {
            return null;
        }

        return 100;
    }
}

<?php

namespace Art4\RectorBcLibrary\Tests\BackwardCompatibleReturnTypeFromStrictTypedPropertyRector;

final class SomeClass
{
    private int $age = 100;

    public function getAge(): mixed
    {
        return $this->age;
    }
}

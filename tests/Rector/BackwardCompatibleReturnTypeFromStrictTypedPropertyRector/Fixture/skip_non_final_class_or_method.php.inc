<?php

namespace Art4\RectorBcLibrary\Tests\BackwardCompatibleReturnTypeFromStrictTypedPropertyRector;

class SomeClass
{
    private int $age = 100;

    public function getAge()
    {
        return $this->age;
    }
}

<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorParamType\AddParamTypeFromPropertyTypeRector\Fixture;

class SomeClass
{
    private string $name;

    public function setName($name)
    {
        $this->name = $name;
    }
}
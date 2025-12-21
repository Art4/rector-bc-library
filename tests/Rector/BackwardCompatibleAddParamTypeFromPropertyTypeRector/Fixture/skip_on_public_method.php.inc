<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleAddParamTypeFromPropertyTypeRector\Fixture;

class SomeClass
{
    private string $name;

    public function setName($name)
    {
        $this->name = $name;
    }
}

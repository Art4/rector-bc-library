<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleTypedPropertyFromStrictConstructorRector\Fixture;

class SomeClass
{
    protected $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}

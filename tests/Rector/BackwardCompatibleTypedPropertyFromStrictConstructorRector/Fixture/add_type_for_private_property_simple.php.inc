<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleTypedPropertyFromStrictConstructorRector\Fixture;

class SomeClass
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleTypedPropertyFromStrictConstructorRector\Fixture;

class SomeClass
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}

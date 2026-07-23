<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorPropertyType\TypedPropertyFromStrictConstructorRector\Fixture;

final class SomeClass
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorPropertyType\TypedPropertyFromStrictConstructorRector\Fixture;

final class SomeClass
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
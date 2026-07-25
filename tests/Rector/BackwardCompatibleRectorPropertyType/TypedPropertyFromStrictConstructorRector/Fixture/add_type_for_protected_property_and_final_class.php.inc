<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorPropertyType\TypedPropertyFromStrictConstructorRector\Fixture;

final class SomeClass
{
    protected $name;

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
    protected string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
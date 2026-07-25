<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorPropertyType\TypedPropertyFromStrictConstructorRector\Fixture;

class SomeClass
{
    public $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorPropertyType\TypedPropertyFromStrictConstructorRector\Fixture;

class SomeClass
{
    /**
     * @var string
     */
    public $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
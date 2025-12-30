<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleTypedPropertyFromStrictConstructorRector\Fixture;

final class SomeClass
{
    public $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleTypedPropertyFromStrictConstructorRector\Fixture;

final class SomeClass
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

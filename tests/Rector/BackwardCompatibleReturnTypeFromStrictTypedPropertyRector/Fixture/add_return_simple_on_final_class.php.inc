<?php

namespace Art4\RectorBcLibrary\Tests\BackwardCompatibleReturnTypeFromStrictTypedPropertyRector;

final class SomeClass
{
    private int $age = 100;

    public function getAge()
    {
        return $this->age;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\BackwardCompatibleReturnTypeFromStrictTypedPropertyRector;

final class SomeClass
{
    private int $age = 100;

    public function getAge(): int
    {
        return $this->age;
    }
}

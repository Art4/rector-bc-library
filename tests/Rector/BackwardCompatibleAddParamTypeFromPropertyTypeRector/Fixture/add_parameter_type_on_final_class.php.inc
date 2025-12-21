<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleAddParamTypeFromPropertyTypeRector\Fixture;

final class SomeClass
{
    private string $name;

    public function setName($name)
    {
        $this->name = $name;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleAddParamTypeFromPropertyTypeRector\Fixture;

final class SomeClass
{
    private string $name;

    public function setName(string $name)
    {
        $this->name = $name;
    }
}

<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleAddParamTypeFromPropertyTypeRector\Fixture;

class SomeClass
{
    private string $name;

    final public function setName($name)
    {
        $this->name = $name;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleAddParamTypeFromPropertyTypeRector\Fixture;

class SomeClass
{
    private string $name;

    final public function setName(string $name)
    {
        $this->name = $name;
    }
}

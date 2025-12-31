<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleAddParamStringTypeFromSprintfUseRector\Fixture;

class SomeClass
{
    final public function formatMessage($name)
    {
        return sprintf('My name is %s', $name);
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleAddParamStringTypeFromSprintfUseRector\Fixture;

class SomeClass
{
    final public function formatMessage(string $name)
    {
        return sprintf('My name is %s', $name);
    }
}

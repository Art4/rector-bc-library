<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleAddParamStringTypeFromSprintfUseRector\Fixture;

final class SomeClass
{
    public function formatMessage($name)
    {
        return sprintf('My name is %s', $name);
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleAddParamStringTypeFromSprintfUseRector\Fixture;

final class SomeClass
{
    public function formatMessage(string $name)
    {
        return sprintf('My name is %s', $name);
    }
}

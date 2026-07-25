<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorParamTypeOnClass\AddParamFromDimFetchKeyUseRector\Fixture;

class SomeClass
{
    private function get($key)
    {
        $data = [
            'name' => 'John',
            'age' => 30,
        ];

        return $data[$key];
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorParamTypeOnClass\AddParamFromDimFetchKeyUseRector\Fixture;

class SomeClass
{
    private function get(string $key)
    {
        $data = [
            'name' => 'John',
            'age' => 30,
        ];

        return $data[$key];
    }
}
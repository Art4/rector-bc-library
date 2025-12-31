<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleAddParamFromDimFetchKeyUseRector\Fixture;

class SomeClass
{
    public function get($key)
    {
        $data = [
            'name' => 'John',
            'age' => 30,
        ];

        return $data[$key];
    }
}

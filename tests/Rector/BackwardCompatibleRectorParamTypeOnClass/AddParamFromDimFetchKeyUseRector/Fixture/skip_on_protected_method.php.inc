<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorParamTypeOnClass\AddParamFromDimFetchKeyUseRector\Fixture;

class SomeClass
{
    protected function get($key)
    {
        $data = [
            'name' => 'John',
            'age' => 30,
        ];

        return $data[$key];
    }
}
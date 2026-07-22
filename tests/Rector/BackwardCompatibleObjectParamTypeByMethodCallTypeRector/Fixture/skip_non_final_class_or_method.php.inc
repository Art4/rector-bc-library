<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleObjectParamTypeByMethodCallTypeRector\Fixture;

class SomeTypedService
{
    public function run(\stdClass $object): void
    {}
}

class UseDependency
{
    public function __construct(
        private SomeTypedService $someTypedService
    ) {
    }

    public function go($value)
    {
        $this->someTypedService->run($value);
    }
}

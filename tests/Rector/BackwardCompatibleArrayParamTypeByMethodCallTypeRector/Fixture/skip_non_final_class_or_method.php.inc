<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleArrayParamTypeByMethodCallTypeRector\Fixture;

class SomeTypedService
{
    public function run(array $items): void
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

<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleParamTypeByMethodCallTypeRector\Fixture;

class SomeTypedService
{
    public function run(string $name): void
    {}
}

class UseDependency
{
    public function __construct(
        private SomeTypedService $someTypedService
    ) {
    }

    final public function go($value)
    {
        $this->someTypedService->run($value);
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleParamTypeByMethodCallTypeRector\Fixture;

class SomeTypedService
{
    public function run(string $name): void
    {}
}

class UseDependency
{
    public function __construct(
        private SomeTypedService $someTypedService
    ) {
    }

    final public function go(string $value)
    {
        $this->someTypedService->run($value);
    }
}

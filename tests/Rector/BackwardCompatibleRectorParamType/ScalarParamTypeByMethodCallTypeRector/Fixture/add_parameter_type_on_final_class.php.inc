<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorParamType\ScalarParamTypeByMethodCallTypeRector\Fixture;

class SomeTypedService
{
    public function run(int $number): void
    {}
}

final class UseDependency
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
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorParamType\ScalarParamTypeByMethodCallTypeRector\Fixture;

class SomeTypedService
{
    public function run(int $number): void
    {}
}

final class UseDependency
{
    public function __construct(
        private SomeTypedService $someTypedService
    ) {
    }

    public function go(int $value)
    {
        $this->someTypedService->run($value);
    }
}
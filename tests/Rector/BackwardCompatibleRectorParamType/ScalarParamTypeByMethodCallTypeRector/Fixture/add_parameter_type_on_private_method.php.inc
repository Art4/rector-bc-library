<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorParamType\ScalarParamTypeByMethodCallTypeRector\Fixture;

interface SomeTypedService
{
    public function run(int $number);
}

class UseDependency
{
    public function __construct(
        private SomeTypedService $someTypedService
    ) {
    }

    private function go($value)
    {
        $this->someTypedService->run($value);
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorParamType\ScalarParamTypeByMethodCallTypeRector\Fixture;

interface SomeTypedService
{
    public function run(int $number);
}

class UseDependency
{
    public function __construct(
        private SomeTypedService $someTypedService
    ) {
    }

    private function go(int $value)
    {
        $this->someTypedService->run($value);
    }
}
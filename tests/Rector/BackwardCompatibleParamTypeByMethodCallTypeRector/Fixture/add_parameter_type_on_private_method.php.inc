<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleParamTypeByMethodCallTypeRector\Fixture;

interface SomeTypedService
{
    public function run(string $name);
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

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleParamTypeByMethodCallTypeRector\Fixture;

interface SomeTypedService
{
    public function run(string $name);
}

class UseDependency
{
    public function __construct(
        private SomeTypedService $someTypedService
    ) {
    }

    private function go(string $value)
    {
        $this->someTypedService->run($value);
    }
}

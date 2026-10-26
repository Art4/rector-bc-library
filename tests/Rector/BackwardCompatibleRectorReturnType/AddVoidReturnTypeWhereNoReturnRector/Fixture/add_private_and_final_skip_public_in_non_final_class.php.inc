<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\AddVoidReturnTypeWhereNoReturnRector\Fixture;

class MixedClass
{
    public function publicValues()
    {
        return;
    }

    protected function protectedValues()
    {
        return;
    }

    private function privateValues()
    {
        return;
    }

    final public function finalValues()
    {
        return;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\AddVoidReturnTypeWhereNoReturnRector\Fixture;

class MixedClass
{
    public function publicValues()
    {
        return;
    }

    protected function protectedValues()
    {
        return;
    }

    private function privateValues(): void
    {
        return;
    }

    final public function finalValues(): void
    {
        return;
    }
}

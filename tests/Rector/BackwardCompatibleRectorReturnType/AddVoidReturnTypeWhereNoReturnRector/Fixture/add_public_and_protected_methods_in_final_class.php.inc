<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\AddVoidReturnTypeWhereNoReturnRector\Fixture;

final class FinalMixedClass
{
    public function publicValues()
    {
        return;
    }

    protected function protectedValues()
    {
        return;
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\AddVoidReturnTypeWhereNoReturnRector\Fixture;

final class FinalMixedClass
{
    public function publicValues(): void
    {
        return;
    }

    protected function protectedValues(): void
    {
        return;
    }
}

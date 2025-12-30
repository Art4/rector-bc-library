<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromReturnCastRector\Fixture;

class SomeClass
{
    private function action($param)
    {
        try {
            return (array) $param;
        } catch (Exception $exception) {
            // some logging
            throw $exception;
        }
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromReturnCastRector\Fixture;

class SomeClass
{
    private function action($param): array
    {
        try {
            return (array) $param;
        } catch (Exception $exception) {
            // some logging
            throw $exception;
        }
    }
}

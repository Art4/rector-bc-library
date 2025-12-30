<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleReturnTypeFromReturnCastRector\Fixture;

final class SomeClass
{
    public function action($param): mixed
    {
        try {
            return (array) $param;
        } catch (Exception $exception) {
            // some logging
            throw $exception;
        }
    }
}

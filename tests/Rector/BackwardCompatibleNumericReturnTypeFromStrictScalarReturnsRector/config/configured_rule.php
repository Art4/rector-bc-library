<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Art4\RectorBcLibrary\Rector\BackwardCompatibleNumericReturnTypeFromStrictScalarReturnsRector;
use Rector\TypeDeclaration\Rector\ClassMethod\NumericReturnTypeFromStrictScalarReturnsRector as OriginalAddVoidReturnTypeRector;

return RectorConfig::configure()
    ->withRules([
        BackwardCompatibleNumericReturnTypeFromStrictScalarReturnsRector::class,
    ])
    ->withSkip([
        OriginalAddVoidReturnTypeRector::class,
    ]);

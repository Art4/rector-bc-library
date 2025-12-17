<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Art4\RectorBcLibrary\Rector\BackwardCompatibleNumericReturnTypeFromStrictReturnsRector;
use Rector\TypeDeclaration\Rector\ClassMethod\NumericReturnTypeFromStrictReturnsRector as OriginalRector;

return RectorConfig::configure()
    ->withRules([
        BackwardCompatibleNumericReturnTypeFromStrictReturnsRector::class,
    ])
    ->withSkip([
        OriginalRector::class,
    ]);

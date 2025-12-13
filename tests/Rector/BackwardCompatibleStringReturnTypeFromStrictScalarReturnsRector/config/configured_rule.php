<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Art4\RectorBcLibrary\Rector\BackwardCompatibleStringReturnTypeFromStrictScalarReturnsRector;
use Rector\TypeDeclaration\Rector\ClassMethod\StringReturnTypeFromStrictScalarReturnsRector as OriginalStringReturnTypeFromStrictScalarReturnsRector;

return RectorConfig::configure()
    ->withRules([
        BackwardCompatibleStringReturnTypeFromStrictScalarReturnsRector::class,
    ])
    ->withSkip([
        OriginalStringReturnTypeFromStrictScalarReturnsRector::class,
    ]);

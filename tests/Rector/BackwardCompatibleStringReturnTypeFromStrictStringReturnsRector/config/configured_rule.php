<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Art4\RectorBcLibrary\Rector\BackwardCompatibleStringReturnTypeFromStrictStringReturnsRector;
use Rector\TypeDeclaration\Rector\ClassMethod\StringReturnTypeFromStrictStringReturnsRector as OriginalStringReturnTypeFromStrictStringReturnsRector;

return RectorConfig::configure()
    ->withRules([
        BackwardCompatibleStringReturnTypeFromStrictStringReturnsRector::class,
    ])
    ->withSkip([
        OriginalStringReturnTypeFromStrictStringReturnsRector::class,
    ]);
